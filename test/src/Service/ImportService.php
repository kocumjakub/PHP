<?php

namespace App\Service;

use App\Mapper\CarrierMapper;
use App\Validator\InputValidator;
use App\Exception\CarrierNotFoundException;
use App\Exception\NotReadCarrierFile;

class ImportService
{
    public function __construct(
        private CarrierMapper $carrierMapper,
        private InputValidator $inputValidator
    )
    {}

    public function import(string $input): bool
    {
        if ($this->inputValidator->validate($input) === false) {
            throw new \InvalidArgumentException("Carrier not fond in supported carriers.");
        }

        $carrier = $this->carrierMapper->mapCarrierFromEnumToClass($input);
        if ($carrier === null) {
            throw new CarrierNotFoundException('Carrier not found for importer.');
        }

        $file = $carrier->loadImportFile();
        if ($file === false){
            throw new NotReadCarrierFile('Carrier file not read.');
        }

        $pointData = $carrier->parseCarrierFile($file);

        $result = $carrier->saveCarrierPointIntoDatabase($pointData);

        return $result;
    }
}