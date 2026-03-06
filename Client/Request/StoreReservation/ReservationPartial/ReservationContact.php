<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\ReservationPartial;

use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class ReservationContact
{
    public function __construct(
        private string $name,
        private bool $paid,
        private string $text,
        private string $email,
        #[SerializedName('statusCode')]
        private string $statusCode,
        #[SerializedName('totalPrice')]
        private string $totalPrice,
        #[SerializedName('extContractCode')]
        private string $extContractCode,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }

    public function getExtContractCode(): string
    {
        return $this->extContractCode;
    }
}
