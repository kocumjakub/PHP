<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Request\Order;

use Csag\Bundle\AnsCoreBundle\Client\Request\Order\OrderPartial\AnsOrderContract;
use Csag\Bundle\AnsCoreBundle\Client\Request\Order\OrderPartial\AnsOrderItem;
use Symfony\Component\Serializer\Attribute\SerializedName;

class OrderAnsRequest
{
    /**
     * @param array<int,AnsOrderItem> $items
     */
    public function __construct(
        private readonly int $year,
        private readonly string $agenda,
        #[SerializedName('documentGroupCode')]
        private readonly int $documentGroupCode,
        #[SerializedName('registrationNumber')]
        private readonly string $registrationNumber,
        #[SerializedName('internalNumber')]
        private readonly int $internalNumber,
        #[SerializedName('deliveryRegistrationNumber')]
        private readonly string $deliveryRegistrationNumber,
        #[SerializedName('deliveryInternalNumber')]
        private readonly int $deliveryInternalNumber,
        private readonly string $text,
        private readonly string $text0,
        #[SerializedName('createdDate')]
        private readonly string $createdDate,
        #[SerializedName('extContractCode')]
        private readonly string $extContractCode,
        #[SerializedName('currencyCode')]
        private readonly string $currencyCode,
        #[SerializedName('variableSymbol')]
        private readonly int $variableSymbol,
        #[SerializedName('pairingSymbol')]
        private readonly string $pairingSymbol,
        #[SerializedName('employeeId')]
        private readonly int $employeeId,
        private readonly AnsOrderContract $contract,
        private array $items = [],
    ) {
    }

    /**
     * @param array<int,AnsOrderItem> $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return array<int,AnsOrderItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getAgenda(): string
    {
        return $this->agenda;
    }

    public function getDocumentGroupCode(): int
    {
        return $this->documentGroupCode;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function getInternalNumber(): int
    {
        return $this->internalNumber;
    }

    public function getDeliveryRegistrationNumber(): string
    {
        return $this->deliveryRegistrationNumber;
    }

    public function getDeliveryInternalNumber(): int
    {
        return $this->deliveryInternalNumber;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getText0(): string
    {
        return $this->text0;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function getExtContractCode(): string
    {
        return $this->extContractCode;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getVariableSymbol(): int
    {
        return $this->variableSymbol;
    }

    public function getPairingSymbol(): string
    {
        return $this->pairingSymbol;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function getContract(): AnsOrderContract
    {
        return $this->contract;
    }
}
