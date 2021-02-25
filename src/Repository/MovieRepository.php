<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * @return Movie[] Returns an array of Movie objects
     */    
    public function findAllOrderedByTitleAsc($query)
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.title', 'ASC')
            ->where('m.title LIKE :title')
            ->setParameter('title', '%' . $query . '%')
            ->getQuery()
            ->getResult()
        ;

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Movie m
            ORDER BY m.title ASC');
        return $query->getResult();
    }

    public function findAllInOneRQ($id)
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('m.castings', 'c')
            ->innerJoin('c.person', 'p')
            ->addSelect('c')
            ->addSelect('p')
            ->andWhere('m.id = :id')
            ->setParameter('id', $id)
            ->addOrderBy('c.credit_order', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function search($query)
    {
        return $this->createQueryBuilder('m')
            ->where('m.title LIKE :title')
            ->setParameter('title', '%' . $query . '%')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Movie[] Returns an array of Movie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
