<?php

namespace App\Repository;

use App\Entity\CarrierPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class CarrierPointRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $entityManager
    )
    {
        parent::__construct($registry, CarrierPoint::class);
    }

    public function saveEntityCarrierPoint(array $carrierPoints)
    {
        foreach($carrierPoints as $point) {
            $this->entityManager->persist($point);
        }

        $this->entityManager->flush();
    }
}