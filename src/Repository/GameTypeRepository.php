<?php

namespace App\Repository;

use App\Entity\GameType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameType>
 *
 * @method GameType|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameType|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameType[]    findAll()
 * @method GameType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameType::class);
    }
    public function add(GameType $gameType){

        $this->getEntityManager()->persist($gameType);
        $this->getEntityManager()->flush();
    }

    
    public function findByName(string $name)
    {
        $query =$this->getEntityManager()->createQuery("SELECT t FROM ".GameType::class." t WHERE t.name='$name'");
        return $query->getResult();
    }
//    /**
//     * @return GameType[] Returns an array of GameType objects
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

//    public function findOneBySomeField($value): ?GameType
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
