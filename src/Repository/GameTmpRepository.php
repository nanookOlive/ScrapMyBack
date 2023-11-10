<?php

namespace App\Repository;

use App\Entity\GameTmp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameTmp>
 *
 * @method GameTmp|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameTmp|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameTmp[]    findAll()
 * @method GameTmp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameTmpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameTmp::class);
    }

    public function add(GameTmp $gameTmp){

        $this->getEntityManager()->persist($gameTmp);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return GameTmp[] Returns an array of GameTmp objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GameTmp
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
