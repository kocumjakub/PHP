<?php

namespace App\Carriers;

use App\Dto\OpenHourPerDayDto;
use SimpleXMLElement;
use App\Factory\CarrierEnttityFactory;
use App\Factory\CarrierPointDtoFactory;
use App\Enum\CarrierEnum;
use App\Enum\CountryEnum;
use App\Enum\StatusEnum;
use App\Enum\TypeEnum;
use App\Repository\CarrierPointRepository;

class SlovenskaPosta implements CarrierInterface
{
    private const XML_URL_SLOVENSKA_POSTA = 'http://www.posta.sk/public/forms/zoznam_post.xml';

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
        return simplexml_load_file(self::XML_URL_SLOVENSKA_POSTA);
    }

    public function parseCarrierFile(SimpleXMLElement $fileXml): array
    {
        $carrierPoints = [];

        foreach($fileXml->POSTA as $xmlRow) {
            $openHours = $this->getOpenHoursFromXml($xmlRow->HODINY_PRE_VEREJNOST);
            $carrierPoints[] = $this->carrierDtoFactory->createCarrierPointDtoSlovenskaPosta($xmlRow, $openHours);
        }

        return $carrierPoints;
    }

    public function saveCarrierPointIntoDatabase(array $points): bool
    {
        $carrierEntities= [];
        $index = 0;
        $externalId = 0;

        foreach($points as $point) {
            $externalId++;
            $carrierEntities[] = $this->carrierEnttityFactory->createEntityCarrierPoint(
                $point,
                CarrierEnum::SLOVENSKA_POSTA,
                CountryEnum::SK,
                StatusEnum::AVAIABLE,
                TypeEnum::POINT,
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

    private function getOpenHoursFromXml(SimpleXMLElement $xmlElement): array
    {
        return [
            new OpenHourPerDayDto('PONDELOK',$xmlElement->PONDELOK->OD, $xmlElement->PONDELOK->DO),
            new OpenHourPerDayDto('UTOROK',$xmlElement->UTOROK->OD, $xmlElement->UTOROK->DO),
            new OpenHourPerDayDto('STREDA',$xmlElement->STREDA->OD, $xmlElement->STREDA->DO),
            new OpenHourPerDayDto('STVRTOK',$xmlElement->STVRTOK->OD, $xmlElement->STVRTOK->DO),
            new OpenHourPerDayDto('PIATOK',$xmlElement->PIATOK->OD, $xmlElement->PIATOK->DO)
        ];
    }
}