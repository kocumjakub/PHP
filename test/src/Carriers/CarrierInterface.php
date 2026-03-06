<?php

namespace App\Carriers;

use SimpleXMLElement;

interface CarrierInterface
{
    public function loadImportFile() : SimpleXMLElement|false;

    public function parseCarrierFile(SimpleXMLElement $fileXml) : array;

    public function saveCarrierPointIntoDatabase(array $points) : bool;
}