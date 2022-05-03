<?php

namespace App\Repository;

use App\Entity\AgeSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgeSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgeSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgeSection[]    findAll()
 * @method AgeSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgeSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgeSection::class);
    }

    // /**
    //  * @return AgeSection[] Returns an array of AgeSection objects
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
    public function findOneBySomeField($value): ?AgeSection
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
