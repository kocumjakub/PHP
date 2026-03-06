<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\ReservationPartial;

use Symfony\Component\Serializer\Attribute\SerializedName;

abstract readonly class ReservationAddress
{
    public const string NAME = 'address';

    public function __construct(
        private string $name,
        #[SerializedName('firstName')]
        private string $firstName,
        #[SerializedName('lastName')]
        private string $lastName,
        #[SerializedName('registrationNumber')]
        private string $registrationNumber,
        private string $email,
        #[SerializedName('phoneNumber')]
        private string $phoneNumber,
        #[SerializedName('currencyCode')]
        private string $currencyCode,
        #[SerializedName('countryCode')]
        private string $countryCode,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
