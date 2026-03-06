<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation;

use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class UpdateStoreReservationRequest
{
    public function __construct(
        #[SerializedName('statusCode')]
        private ?string $statusCode,
    ) {
    }

    public function getStatusCode(): ?string
    {
        return $this->statusCode;
    }
}
