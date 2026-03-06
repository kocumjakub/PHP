<?php

namespace App\Carriers;

use SimpleXMLElement;

class GlsCarrier implements CarrierInterface
{
    private const XML_URL_GLS = 'https://ps-maps.gls-czech.com/getDropoffPoints.php';

    public function loadImportFile(): SimpleXMLElement|false
    {
        return false;
    }

    public function parseCarrierFile(SimpleXMLElement $fileXml): array
    {
        return [];
    }

    public function saveCarrierPointIntoDatabase(array $points): bool
    {
        return false;
    }
}