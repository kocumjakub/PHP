<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Response\StoreReservation;

use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class UpdateStoreReservationResponse
{
    public function __construct(
        private string $code,
        #[SerializedName('typeCode')]
        private string $typeCode,
        #[SerializedName('groupCode')]
        private int $groupCode,
        #[SerializedName('statusCode')]
        private int $statusCode,
        #[SerializedName('statusName')]
        private string $statusName,
        #[SerializedName('relatedContractCode')]
        private string $relatedContractCode,
        private string $name,
        #[SerializedName('totalPrice')]
        private float $totalPrice,
        private string $text,
        #[SerializedName('partnerUid')]
        private int $partnerUid,
        #[SerializedName('invoiceAddressUid')]
        private int $invoiceAddressUid,
        #[SerializedName('deliveryAddressUid')]
        private int $deliveryAddressUid,
        #[SerializedName('extContractCode')]
        private string $extContractCode,
        private string $email,
        private bool $paid,
        #[SerializedName('completionDate')]
        private string $completionDate,
        #[SerializedName('expectedCompletionDate')]
        private string $expectedCompletionDate,
        #[SerializedName('actualCompletionDate')]
        private string $actualCompletionDate,
        #[SerializedName('employeeCode')]
        private int $employeeCode,
        private int $uid,
        #[SerializedName('dateUpdated')]
        private string $dateUpdated,
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTypeCode(): string
    {
        return $this->typeCode;
    }

    public function getGroupCode(): int
    {
        return $this->groupCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getStatusName(): string
    {
        return $this->statusName;
    }

    public function getRelatedContractCode(): string
    {
        return $this->relatedContractCode;
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

    public function getPartnerUid(): int
    {
        return $this->partnerUid;
    }

    public function getInvoiceAddressUid(): int
    {
        return $this->invoiceAddressUid;
    }

    public function getDeliveryAddressUid(): int
    {
        return $this->deliveryAddressUid;
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

    public function getCompletionDate(): string
    {
        return $this->completionDate;
    }

    public function getExpectedCompletionDate(): string
    {
        return $this->expectedCompletionDate;
    }

    public function getActualCompletionDate(): string
    {
        return $this->actualCompletionDate;
    }

    public function getEmployeeCode(): int
    {
        return $this->employeeCode;
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
