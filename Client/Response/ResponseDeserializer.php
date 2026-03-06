<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Response;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ResponseDeserializer
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function deserializeResponse(ResponseInterface $response, string $responseFqcn): object
    {
        return $this->serializer->deserialize($response->getBody()->getContents(), $responseFqcn, 'json');
    }
}
