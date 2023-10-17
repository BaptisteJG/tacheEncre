<?php

namespace App\Repository;

use App\Entity\Sujet;
use App\Model\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Sujet>
 *
 * @method Sujet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sujet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sujet[]    findAll()
 * @method Sujet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SujetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sujet::class);
    }

    /**
    * Query pour la pagination
    */
    public function paginationQuery()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
        ;
    }

        /**
    * Query pour la pagination de CommandeClient
    */
    public function paginationClientQuery($parameters)
    {
        $queryBuilder = $this->createQueryBuilder('c')
        ->orderBy('c.id', 'ASC');

        foreach ($parameters as $key => $value) {
            $queryBuilder->andWhere("c.$key = :$key")
                ->setParameter($key, $value);
        }

        return $queryBuilder->getQuery();
    }

//    /**
//     * @return Sujet[] Returns an array of Sujet objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sujet
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
     * Affichage des valeur de la recherche
     */
    public function findBySearch(SearchData $searchData)
    {
        $queryBuilder = $this->createQueryBuilder('s')
            ->leftJoin('s.commande', 'c') 
            ->orderBy('s.id', 'ASC');

        if(!empty($searchData->q)) {
            // Rechercher des commandes où le nom de l'utilisateur ressemble à la valeur de recherche
            $queryBuilder
                ->andWhere('c.id LIKE :q')
                ->setParameter('q', "%{$searchData->q}%");
        }

        $query = $queryBuilder->getQuery();

        // Obtenez les résultats non paginés
        $results = $query->getResult();

        // Pagination manuelle
        $page = $searchData->page;
        // Nombre d'éléments par page
        $perPage = 10; 
        $offset = ($page - 1) * $perPage;
        $paginatedResults = array_slice($results, $offset, $perPage);

        return $paginatedResults;
    }
}
