<?php

namespace App\Repository;

use App\Entity\TypesCadres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypesCadres>
 *
 * @method TypesCadres|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypesCadres|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypesCadres[]    findAll()
 * @method TypesCadres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypesCadresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypesCadres::class);
    }

//    /**
//     * @return TypesCadres[] Returns an array of TypesCadres objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypesCadres
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
