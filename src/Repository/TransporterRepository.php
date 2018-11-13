<?php

namespace App\Repository;

use App\Entity\Transporter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Transporter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transporter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transporter[]    findAll()
 * @method Transporter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransporterRepository extends ServiceEntityRepository
{
    /**
     * TransporterRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Transporter::class);
    }
}
