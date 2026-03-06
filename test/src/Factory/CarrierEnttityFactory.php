<?php

namespace App\Factory;

use DateTimeImmutable;
use App\Dto\CarrierPointDto;
use App\Entity\CarrierPoint;
use App\Enum\CarrierEnum;
use App\Enum\CountryEnum;
use App\Enum\StatusEnum;
use App\Enum\TypeEnum;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class CarrierEnttityFactory
{
    private Serializer $serializer;
    public function __construct(
    )
    {
        $this->serializer = new Serializer([new ObjectNormalizer()],[new JsonEncoder()]);
    }

    public function createEntityCarrierPoint(
        CarrierPointDto $carrierPointDto, 
        CarrierEnum $carrierEnum, 
        CountryEnum $countryEnum,
        StatusEnum $statusEnum,
        TypeEnum $typeEnum,
        int $externalId
    ): CarrierPoint
    {
        $openHoursJson = $this->serializer->serialize($carrierPointDto->getOpeningHours(),'json');
        return new CarrierPoint(
            $carrierPointDto->getAdress(),
            $carrierEnum,
            $carrierPointDto->getCity(),
            $countryEnum->value,
            new DateTimeImmutable(),
            $carrierPointDto->getExternalId() ?? (string) $externalId,
            $carrierPointDto->getLatitude(),
            $carrierPointDto->getLongitude(),
            $carrierPointDto->getName(),
            $openHoursJson,
            $statusEnum,
            $typeEnum,
            $carrierPointDto->getZipCode()
        );
    }
}