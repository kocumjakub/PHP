<?php

namespace App\Dto;

class CarrierPointDto
{
    public function __construct(
        private string $adress,
        private string $city,
        private ?string $externalId,
        private float $latitude,
        private float $longitude,
        private string $name,
        private array $openingHours,
        private string $zipCode,
        private ?string $status,
        private ?string $boxProvider
    )
    {
        
    }

        /**
         * Get the value of adress
         */ 
        public function getAdress()
        {
                return $this->adress;
        }

        /**
         * Get the value of city
         */ 
        public function getCity()
        {
                return $this->city;
        }

        /**
         * Get the value of externalId
         */ 
        public function getExternalId()
        {
                return $this->externalId;
        }

        /**
         * Get the value of latitude
         */ 
        public function getLatitude()
        {
                return $this->latitude;
        }

        /**
         * Get the value of longitude
         */ 
        public function getLongitude()
        {
                return $this->longitude;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Get the value of openingHours
         */ 
        public function getOpeningHours()
        {
                return $this->openingHours;
        }

        /**
         * Get the value of zipCode
         */ 
        public function getZipCode()
        {
                return $this->zipCode;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Get the value of boxProvider
         */ 
        public function getBoxProvider()
        {
                return $this->boxProvider;
        }
}