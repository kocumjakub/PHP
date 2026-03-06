<?php

namespace App\Enum;

enum CarrierEnum : string 
{
    case BALIKOVNA = 'balikovna';

    case GLS = 'gls';

    case SLOVENSKA_POSTA = 'slovenskaPosta';

    public static function supportedCarriers(string $carrier): bool
    {
        return in_array($carrier, array_column(self::cases(),'value')) === true;
    }
}