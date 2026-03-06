<?php

namespace App\Factory;

use DateTimeImmutable;
use SimpleXMLElement;
use App\Dto\CarrierPointDto;
use App\Enum\CarrierEnum;
use App\Enum\CountryEnum;

class CarrierPointDtoFactory
{
    public function __construct()
    {
        
    }

    public function createCarrierPointDtoBalikovna(SimpleXMLElement $xmlRow, array $openHours): CarrierPointDto
    {
        $parseAddress = explode(',',$xmlRow->ADRESA);
        return new CarrierPointDto(
            join(',',$parseAddress),
            end($parseAddress),
            null,
            (float) $xmlRow->SOUR_X_WGS84,
            (float) $xmlRow->SOUR_Y_WGS84,
            $xmlRow->NAZEV,
            $openHours,
            $xmlRow->PSC,
            $xmlRow->STAV,
            $xmlRow->BOX_PROVIDER
        );
    }

    public function createCarrierPointDtoSlovenskaPosta(SimpleXMLElement $xmlRow, array $openHours): CarrierPointDto
    {
        $address = $xmlRow->ADRESA;
        return new CarrierPointDto(
            join(',',[$address->ULICA,$address->CISLO,$address->OBEC]),
            $address->OBEC,
            $xmlRow->ID,
            (float) $xmlRow->GPS->LATITUDE,
            (float) $xmlRow->GPS->LONGITUDE,
            $xmlRow->NAZOV,
            $openHours,
            $xmlRow->PSC,
            NULL,
            NULL
        );
    }
}