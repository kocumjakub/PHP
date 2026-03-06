<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Utils;

use Csag\Bundle\AnsCoreBundle\Client\Exception\AbstractAnsException;
use Csag\Bundle\AnsCoreBundle\Client\Exception\AnsClientException;
use Csag\Bundle\AnsCoreBundle\Client\Exception\AnsServerException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;

class AnsExceptionType
{
    public function getExceptionType(int $httpCode): ?string
    {
        $type = null;

        if ($httpCode >= Response::HTTP_BAD_REQUEST && $httpCode <= Response::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS) {
            $type = AnsClientException::class;
        }

        if ($httpCode >= Response::HTTP_INTERNAL_SERVER_ERROR && $httpCode <= Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED) {
            $type = AnsServerException::class;
        }

        return $type;
    }

    public function getException(GuzzleException $exception): AbstractAnsException
    {
        if (($exception instanceof BadResponseException) === true || ($exception instanceof RequestException) === true) {
            return new AnsClientException($exception->getMessage(), $exception->getCode(), $exception->getPrevious(), $exception->getResponse());
        }

        return new AnsServerException($exception->getMessage(), $exception->getCode(), $exception->getPrevious(), null);
    }
}
