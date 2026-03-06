<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Request\Order\OrderPartial;

use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class AnsOrderItem
{
    public function __construct(
        #[SerializedName('productCode')]
        private string $productCode,
        private int $quantity,
        private string $ean,
        #[SerializedName('unitPrice')]
        private string $unitPrice,
        #[SerializedName('listUnitPrice')]
        private string $listUnitPrice,
        private string $char1,
        private string $char2,
        private string $char3,
        private string $text,
        #[SerializedName('normCode')]
        private ?string $normCode,
        #[SerializedName('vatGroupCode')]
        private int $vatGroupCode,
        #[SerializedName('itemGuid')]
        private ?int $itemGuid = null,
    ) {
    }

    public function getItemGuid(): ?int
    {
        return $this->itemGuid;
    }

    public function getProductCode(): string
    {
        return $this->productCode;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    public function getUnitPrice(): string
    {
        return $this->unitPrice;
    }

    public function getListUnitPrice(): string
    {
        return $this->listUnitPrice;
    }

    public function getChar1(): string
    {
        return $this->char1;
    }

    public function getChar2(): string
    {
        return $this->char2;
    }

    public function getChar3(): string
    {
        return $this->char3;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getNormCode(): ?string
    {
        return $this->normCode;
    }

    public function getVatGroupCode(): int
    {
        return $this->vatGroupCode;
    }
}
