<?php

namespace App\Repository;

use App\Entity\Codespostaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Codespostaux>
 *
 * @method Codespostaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Codespostaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Codespostaux[]    findAll()
 * @method Codespostaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodespostauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Codespostaux::class);
    }

//    /**
//     * @return Codespostaux[] Returns an array of Codespostaux objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Codespostaux
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
