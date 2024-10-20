<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
    //     */
        public function findAuthorByUsername(string $username)
        {
            return $this->createQueryBuilder('a')
                ->andWhere('a.username = :val')
                ->setParameter('val', $username)
                ->orderBy('a.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getDQL()
            ;
        }

        public function findAuthorByUsernameDQL(string $username)
        {
            return $this->getEntityManager()
            ->createQuery("SELECT a.username FROM App\Entity\Author a WHERE a.username = :val ORDER BY a.id DESC")
            ->setParameter('val', $username)
            ->getResult()
            ;
        }

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
