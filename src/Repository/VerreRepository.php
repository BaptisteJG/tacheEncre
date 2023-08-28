<?php

namespace App\Repository;

use App\Entity\Verre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Verre>
 *
 * @method Verre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Verre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Verre[]    findAll()
 * @method Verre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VerreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Verre::class);
    }

//    /**
//     * @return Verre[] Returns an array of Verre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Verre
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
