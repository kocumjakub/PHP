<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Authentication;

use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsToken;
use Csag\Bundle\AnsCoreBundle\Client\Exception\AbstractAnsException;
use Csag\Bundle\AnsCoreBundle\Client\Exception\AnsClientException;
use Csag\Bundle\AnsCoreBundle\Client\Exception\AnsServerException;
use Csag\Bundle\AnsCoreBundle\Client\Utils\AnsExceptionType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Predis\ClientInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\SerializerInterface;
use Relay\Relay;

class TokenManager
{
    private const string ANS_TOKEN = '-ans-token-';

    public function __construct(
        private ClientInterface|\Redis|\RedisArray|\RedisCluster|Relay $redis,
        private SerializerInterface $serializer,
        private LoggerInterface $logger,
        #[Autowire('%app.ans.url%')]
        private string $ansUrl,
        private string $ansUserName,
        private string $ansPassword,
        private AnsExceptionType $ansExceptionType,
    ) {
    }

    /**
     * @throws AbstractAnsException
     */
    public function getToken(): AnsToken
    {
        $tokenRedis = $this->getTokenFromRedis();
        if (null === $tokenRedis) {
            return $this->getTokenFromAns();
        }

        return $tokenRedis;
    }

    /**
     * @throws AbstractAnsException
     */
    private function getTokenFromAns(): AnsToken
    {
        $client = new Client([
            'headers' => [
                'content-type' => 'application/json',
            ],
        ]);

        try {
            $response = $client->request('POST', sprintf('%s%s', $this->ansUrl, '/api/token'), ['json' => ['userName' => $this->ansUserName, 'password' => $this->ansPassword]]);
            /** @var AnsToken $ansTokenDto */
            $ansTokenDto = $this->serializer->deserialize($response->getBody()->getContents(), AnsToken::class, 'json');
            $this->setTokenToRedis($ansTokenDto);
        } catch (GuzzleException $e) {
            $this->logger->warning('AnsToken request failed because ' . $e->getMessage());
            $type = $this->ansExceptionType->getExceptionType($e->getCode());
            if (method_exists($e, 'getResponse')) {
                $response = $e->getResponse();
            } else {
                $response = null;
            }

            if ($type === AnsClientException::class) {
                throw new AnsClientException(
                    sprintf('AnsToken request failed on client side because: %s', $e->getMessage()),
                    $e->getCode(),
                    $e->getPrevious(),
                    $response
                );
            }

            if ($type === AnsServerException::class) {
                throw new AnsServerException(
                    sprintf('AnsToken request failed on server side because: %s', $e->getMessage()),
                    $e->getCode(),
                    $e->getPrevious(),
                    $response
                );
            }

            throw new AbstractAnsException(
                sprintf('AnsToken request failed because: %s', $e->getMessage()),
                $e->getCode(),
                $e,
                $response
            );
        }

        return $ansTokenDto;
    }

    private function getTokenFromRedis(): ?AnsToken
    {
        try {
            $redisValue = $this->redis->get(self::ANS_TOKEN);
            if ($redisValue === false) {
                return null;
            }

            return $this->serializer->deserialize($redisValue, AnsToken::class, 'json');
        } catch (\RedisException $exception) {
            $this->logger->error($exception->getMessage());

            return null;
        }
    }

    private function setTokenToRedis(AnsToken $ansTokenDto): void
    {
        try {
            $redisValue = $this->serializer->serialize($ansTokenDto, 'json');
            $this->redis->setex(self::ANS_TOKEN, $ansTokenDto->redisTimeToLive(), $redisValue);
        } catch (\RedisException $exception) {
            $this->logger->error($exception->getMessage());
        }
    }
}
