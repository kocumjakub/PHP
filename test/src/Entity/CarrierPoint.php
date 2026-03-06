<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Enum\CarrierEnum;
use App\Enum\StatusEnum;
use App\Enum\TypeEnum;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarrierPointRepository;

#[ORM\Entity(repositoryClass: CarrierPointRepository::class)]
class CarrierPoint
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    public function __construct(
        #[ORM\Column(type:'string',nullable:false)]
        private string $address,
        #[ORM\Column(type:'string', nullable:false, enumType:CarrierEnum::class)]
        private CarrierEnum $carrier,
        #[ORM\Column(type:'string',nullable:false)]
        private string $city,
        #[ORM\Column(type:'string',nullable:false)]
        private string $country = 'CZ',
        #[ORM\Column(type:'datetime_immutable', nullable: false, options: ['default'=> 'CURRENT_TIMESTAMP'])]
        private DateTimeImmutable $created,
        #[ORM\Column(type:'integer',nullable:true)]
        private ?string $externalId = null,
        #[ORM\Column(type:'float',nullable:false)]
        private float $latitude,
        #[ORM\Column(type:'float',nullable:false)]
        private float $longitude,
        #[ORM\Column(type:'string',nullable:false)]
        private string $name,
        #[ORM\Column(type:'string',nullable:false)]
        private string $openingHours,
        #[ORM\Column(type:'string', nullable:false, enumType:StatusEnum::class)]
        private StatusEnum $status,
        #[ORM\Column(type:'string', nullable:false, enumType:TypeEnum::class)]
        private TypeEnum $type,
        #[ORM\Column(type:'string',nullable:false)]
        private string $zipCode,
    )
    {
    }

    /**
     * Get the value of zipCode
     */ 
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set the value of zipCode
     *
     * @return  self
     */ 
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of openingHours
     */ 
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * Set the value of openingHours
     *
     * @return  self
     */ 
    public function setOpeningHours($openingHours)
    {
        $this->openingHours = $openingHours;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of longitude
     */ 
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the value of longitude
     *
     * @return  self
     */ 
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get the value of latitude
     */ 
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the value of latitude
     *
     * @return  self
     */ 
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get the value of externalId
     */ 
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * Set the value of externalId
     *
     * @return  self
     */ 
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * Get the value of created
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */ 
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of carrier
     */ 
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set the value of carrier
     *
     * @return  self
     */ 
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get the value of adress
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of adress
     *
     * @return  self
     */ 
    public function setAddress($adress)
    {
        $this->address = $adress;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}