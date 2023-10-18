<?php

namespace App\Repository;

use App\Entity\Commande;
use App\Model\SearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
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

//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
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
        $queryBuilder = $this->createQueryBuilder('c')
            // Rejoindre la table des utilisateurs (u) liée à la commande (c)
            ->leftJoin('c.user', 'u')
            // ->leftJoin('c.etatCommand', 'e') 
            ->orderBy('c.id', 'ASC');

        if(!empty($searchData->q)) {
            // Rechercher des commandes où le nom de l'utilisateur ressemble à la valeur de recherche
            $queryBuilder
                ->andWhere('u.nom LIKE :q')
                // ->orWhere('e.etatCommand LIKE :q')
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
