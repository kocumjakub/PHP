<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation;

use Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\ReservationPartial\ReservationAddress;
use Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\ReservationPartial\ReservationContact;
use Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\ReservationPartial\ReservationItem;
use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class CreateStoreReservationRequest
{
    /**
     * @param array<int,ReservationItem> $items
     */
    public function __construct(
        private string $text,
        private string $year,
        private array $items,
        private string $text0,
        private string $agenda,
        private ReservationContact $contract,
        #[SerializedName('employeeId')]
        private int $employeeId,
        #[SerializedName('createdDate')]
        private string $createdDate,
        #[SerializedName('currencyCode')]
        private string $currencyCode,
        #[SerializedName('pairingSymbol')]
        private string $pairingSymbol,
        #[SerializedName('internalNumber')]
        private string $internalNumber,
        #[SerializedName('variableSymbol')]
        private ?int $variableSymbol,
        #[SerializedName('extContractCode')]
        private string $extContractCode,
        #[SerializedName('documentGroupCode')]
        private int $documentGroupCode,
        #[SerializedName('registrationNumber')]
        private string $registrationNumber,
        #[SerializedName('stockCodeIn')]
        private string $stockCodeIn,
        private ReservationAddress $address,
        #[SerializedName('currencyQuantity')]
        private ?int $currencyQuantity = null,
        #[SerializedName('currencyRate')]
        private ?float $currencyRate = null,
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @return array<int,ReservationItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getText0(): string
    {
        return $this->text0;
    }

    public function getAgenda(): string
    {
        return $this->agenda;
    }

    public function getContract(): ReservationContact
    {
        return $this->contract;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getPairingSymbol(): string
    {
        return $this->pairingSymbol;
    }

    public function getInternalNumber(): string
    {
        return $this->internalNumber;
    }

    public function getVariableSymbol(): ?int
    {
        return $this->variableSymbol;
    }

    public function getExtContractCode(): string
    {
        return $this->extContractCode;
    }

    public function getDocumentGroupCode(): int
    {
        return $this->documentGroupCode;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function getStockCodeIn(): string
    {
        return $this->stockCodeIn;
    }

    public function getAddress(): ReservationAddress
    {
        return $this->address;
    }

    public function getCurrencyQuantity(): ?int
    {
        return $this->currencyQuantity;
    }

    public function getCurrencyRate(): ?float
    {
        return $this->currencyRate;
    }
}
