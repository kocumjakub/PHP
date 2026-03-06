<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Request\Order\OrderPartial;

use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class AnsOrderContract
{
    public function __construct(
        private string $name,
        #[SerializedName('totalPrice')]
        private float $totalPrice,
        private string $text,
        #[SerializedName('extContractCode')]
        private string $extContractCode,
        private string $email,
        private bool $paid,
        #[SerializedName('statusCode')]
        private int $statusCode,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getExtContractCode(): string
    {
        return $this->extContractCode;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
