<?php

namespace App\Repository;

use App\Entity\EtatCommand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtatCommand>
 *
 * @method EtatCommand|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatCommand|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatCommand[]    findAll()
 * @method EtatCommand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatCommandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatCommand::class);
    }

//    /**
//     * @return EtatCommand[] Returns an array of EtatCommand objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EtatCommand
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
