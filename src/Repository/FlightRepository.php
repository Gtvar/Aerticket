<?php

namespace App\Repository;

use App\Entity\Airport;
use App\Entity\Flight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Flight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flight[]    findAll()
 * @method Flight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightRepository extends ServiceEntityRepository
{
    /**
     * FlightRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    /**
     * Find by Airports and date
     *
     * @param Airport   $departureAirport
     * @param Airport   $arrivalAirport
     * @param \DateTime $dateTime
     *
     * @return Flight[]
     */
    public function findByAirportsAndDate(Airport $departureAirport, Airport $arrivalAirport, \DateTime $dateTime)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.departureAirport = :departureAirport')
            ->andWhere('f.arrivalAirport = :arrivalAirport')
            ->andWhere("DATE(f.departureDateTime) = :departureDate")
            ->setParameters([
                'departureAirport' => $departureAirport,
                'arrivalAirport' => $arrivalAirport,
                'departureDate' => $dateTime->format('Y-m-d'),
            ])
            ->orderBy('f.departureDateTime', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
