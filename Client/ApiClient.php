<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client;

use Csag\Bundle\AnsCoreBundle\Client\Authentication\TokenAuthenticator;
use Csag\Bundle\AnsCoreBundle\Client\Enum\AnsRequestMethod;
use Csag\Bundle\AnsCoreBundle\Client\Exception\AbstractAnsException;
use Csag\Bundle\AnsCoreBundle\Client\Utils\AnsExceptionType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

readonly class ApiClient
{
    public function __construct(
        private TokenAuthenticator $tokenAuthenticator,
        #[Autowire('%app.ans.url%')]
        private string $ansUrl,
        private AnsExceptionType $ansExceptionType,
    ) {
    }

    /**
     * @param mixed[] $body
     * @throws AbstractAnsException
     */
    public function sendRequest(AnsRequestMethod $method, string $url, array $body = []): ResponseInterface
    {
        $this->tokenAuthenticator->authenticate();

        $client = new Client(['headers' => $this->tokenAuthenticator->getAuthenticateHeader()]);

        try {
            return $client->request($method->value, sprintf('%s/api/%s', $this->ansUrl, $url), ['json' => $body]);
        } catch (GuzzleException $e) {
            throw $this->ansExceptionType->getException($e);
        }
    }
}
