<?php

namespace App\Carriers;

use SimpleXMLElement;
use App\Dto\CarrierPointDto;
use App\Dto\OpenHourPerDayDto;
use App\Enum\CarrierEnum;
use App\Enum\CountryEnum;
use App\Enum\StatusEnum;
use App\Enum\TypeEnum;
use App\Factory\CarrierEnttityFactory;
use App\Factory\CarrierPointDtoFactory;
use App\Repository\CarrierPointRepository;
use Exception;

class BalikovnaCarrier implements CarrierInterface
{
    private const XML_URL_BALIKOVNA = 'http://napostu.ceskaposta.cz/vystupy/balikovny.xml';

    private const BATCH_SAVE_POINT = 1000;

    public function __construct(
        private CarrierPointDtoFactory $carrierDtoFactory,
        private CarrierEnttityFactory $carrierEnttityFactory,
        private CarrierPointRepository $carrierPointRepository
    )
    { 
    }

    public function loadImportFile(): SimpleXMLElement|false
    {
        try{
            return simplexml_load_file(self::XML_URL_BALIKOVNA);
        } catch(Exception $e){
            return false;
        }
    }

    public function parseCarrierFile(SimpleXMLElement $fileXml): array
    {
        $carrierPoints = [];

        foreach($fileXml->row as $xmlRow) {
            $openHours = $this->getOpeningHoursFromXml($xmlRow->OTEV_DOBY);
            $carrierPoints[] = $this->carrierDtoFactory->createCarrierPointDtoBalikovna($xmlRow,$openHours);
        }

        return $carrierPoints;
    }

    /**
     * @param CarrierPointDto[] $points
    */
    public function saveCarrierPointIntoDatabase(array $points): bool
    {
        $carrierEntities= [];
        $index = 0;
        $externalId = 0;

        foreach($points as $point) {
            $externalId++;
            $carrierEntities[] = $this->carrierEnttityFactory->createEntityCarrierPoint(
                $point,
                CarrierEnum::BALIKOVNA,
                CountryEnum::CZ,
                $this->getStatusEnum($point->getStatus()) ?? StatusEnum::CLOSED,
                $point->getBoxProvider() === null ? TypeEnum::POINT : TypeEnum::BOX,
                $externalId
            );

            $index++;

            if ($index === self::BATCH_SAVE_POINT){
                $this->carrierPointRepository->saveEntityCarrierPoint($carrierEntities);
                $index = 0;
                $carrierEntities = [];
            }
        }

        return true;
    }
    
    private function getOpeningHoursFromXml(SimpleXMLElement $xmlElement): ?array
    {
        if($xmlElement->den === null) {
            return null;
        }

        $openHours = [];

        foreach($xmlElement->den as $dayXml) {
            $attributes = $dayXml->attributes();
            
            $dayName = $attributes['name'];
            $from = $dayXml->od_do->od;
            $to = $dayXml->od_do->do;

            $openHours[] = new OpenHourPerDayDto(
                $dayName,
                $from,
                $to
            );
        }

        return $openHours;
    }

    private function getStatusEnum(?string $status): ?StatusEnum
    {
        return match ($status) {
             'často vytížená' => StatusEnum::TEMPORARILY_UNAVAILABLE,
             'nová' => StatusEnum::AVAIABLE,
             default => null
        };
    }
}