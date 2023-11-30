<?php

namespace App\Repository;

use App\Entity\Bibliogame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bibliogame>
 *
 * @method Bibliogame|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bibliogame|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bibliogame[]    findAll()
 * @method Bibliogame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BibliogameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bibliogame::class);
    }

//    /**
//     * @return Bibliogame[] Returns an array of Bibliogame objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bibliogame
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
