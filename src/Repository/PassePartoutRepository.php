<?php

namespace App\Repository;

use App\Entity\PassePartout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PassePartout>
 *
 * @method PassePartout|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassePartout|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassePartout[]    findAll()
 * @method PassePartout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassePartoutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PassePartout::class);
    }

//    /**
//     * @return PassePartout[] Returns an array of PassePartout objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PassePartout
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
