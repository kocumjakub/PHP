<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Exception;

use Psr\Http\Message\ResponseInterface;

class AbstractAnsException extends \Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
        private readonly ?ResponseInterface $response = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
