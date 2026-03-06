<?php 

namespace App\Dto;

class OpenHourPerDayDto
{
    public function __construct(
        private ?string $dayName,
        private ?string $from,
        private ?string $to
    )
    {   
    }

    public function getDayName(): string
    {
        return $this->dayName;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }
}