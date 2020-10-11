<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    public function findMaxPrice()
    {
        return $this->createQueryBuilder('a')
            ->select('a.prix')
            ->orderBy('a.prix', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function findMinPrice()
    {
        return $this->createQueryBuilder('a')
            ->select('a.prix')
            ->orderBy('a.prix', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function findMaxKilometrage()
    {
        return $this->createQueryBuilder('a')
            ->select('a.kilometrage')
            ->orderBy('a.kilometrage', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function findMinKilometrage()
    {
        return $this->createQueryBuilder('a')
            ->select('a.kilometrage')
            ->orderBy('a.kilometrage', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function findMaxAnneeCirculation()
    {
        return $this->createQueryBuilder('a')
            ->select('a.anneeMiseCirculation')
            ->orderBy('a.anneeMiseCirculation', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function findMinAnneeCirculation()
    {
        return $this->createQueryBuilder('a')
            ->select('a.anneeMiseCirculation')
            ->orderBy('a.anneeMiseCirculation', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Annonce[] Returns an array of Annonce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Annonce
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
