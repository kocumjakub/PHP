<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Response\StoreReservation;

use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class ChangelogStoreReservationResponseItem
{
    public function __construct(
        #[SerializedName('$id')]
        private string $id,
        #[SerializedName('contractCode')]
        private string $contractCode,
        #[SerializedName('originalColumnName')]
        private string $originalColumnName,
        #[SerializedName('columnName')]
        private string $columnName,
        #[SerializedName('oldValue')]
        private string $oldValue,
        #[SerializedName('newValue')]
        private string $newValue,
        #[SerializedName('uid')]
        private int $uid,
        #[SerializedName('dateUpdated')]
        private string $dateUpdated,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContractCode(): string
    {
        return $this->contractCode;
    }

    public function getOriginalColumnName(): string
    {
        return $this->originalColumnName;
    }

    public function getColumnName(): string
    {
        return $this->columnName;
    }

    public function getOldValue(): string
    {
        return $this->oldValue;
    }

    public function getNewValue(): string
    {
        return $this->newValue;
    }

    public function getUid(): int
    {
        return $this->uid;
    }

    public function getDateUpdated(): string
    {
        return $this->dateUpdated;
    }
}
