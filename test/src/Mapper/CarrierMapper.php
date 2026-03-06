<?php

namespace App\Mapper;

use App\Carriers\BalikovnaCarrier;
use App\Carriers\CarrierInterface;
use App\Carriers\SlovenskaPosta;
use App\Carriers\GlsCarrier;
use App\Enum\CarrierEnum;
use App\Factory\CarrierEnttityFactory;
use App\Factory\CarrierPointDtoFactory;
use App\Repository\CarrierPointRepository;

class CarrierMapper
{
    public function __construct(
        private CarrierPointDtoFactory $carrierDtoFactory,
        private CarrierEnttityFactory $carrierEnttityFactory,
        private CarrierPointRepository $carrierPointRepository
    )
    {
    }

    public function mapCarrierFromEnumToClass(string $carrier): ?CarrierInterface
    {
        return match ($carrier) {
            CarrierEnum::BALIKOVNA->value => new BalikovnaCarrier($this->carrierDtoFactory,$this->carrierEnttityFactory,$this->carrierPointRepository),
            CarrierEnum::GLS->value => new GlsCarrier(),
            CarrierEnum::SLOVENSKA_POSTA->value => new SlovenskaPosta($this->carrierDtoFactory,$this->carrierEnttityFactory,$this->carrierPointRepository),
            default => null
        };
    }
}