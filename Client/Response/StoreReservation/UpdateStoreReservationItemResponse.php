<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Response\StoreReservation;

use Symfony\Component\Serializer\Attribute\SerializedName;

/**
 * Response for update/add item in reservation.
 */
class UpdateStoreReservationItemResponse
{
    public function __construct(
        #[SerializedName('$id')]
        private string $id,
        private int $year,
        private string $agenda,
        #[SerializedName('documentNo')]
        private int $documentNo,
        private int $uid,
    ) {
    }

    public function getUid(): int
    {
        return $this->uid;
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
