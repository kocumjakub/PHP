<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Response\StoreReservation;

use Symfony\Component\Serializer\Attribute\SerializedName;

class CreateStoreReservationResponse
{
    public function __construct(
        #[SerializedName('$id')]
        private string $id,
        private int $year,
        private string $agenda,
        #[SerializedName('documentNo')]
        private int $documentNo,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getAgenda(): string
    {
        return $this->agenda;
    }

    public function getDocumentNo(): int
    {
        return $this->documentNo;
    }
}
