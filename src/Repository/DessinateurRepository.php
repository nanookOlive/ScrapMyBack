<?php

namespace App\Repository;

use App\Entity\Dessinateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dessinateur>
 *
 * @method Dessinateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dessinateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dessinateur[]    findAll()
 * @method Dessinateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DessinateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dessinateur::class);
    }

    public function add(Dessinateur $dessinateur){

        $this->getEntityManager()->persist($dessinateur);
        $this->getEntityManager()->flush();
    }
    public function findByName(string $name)
    {
        $query =$this->getEntityManager()->createQuery("SELECT d FROM ".Dessinateur::class." d WHERE d.name='$name'");
        return $query->getResult();
    }
//    /**
//     * @return Dessinateur[] Returns an array of Dessinateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Dessinateur
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
