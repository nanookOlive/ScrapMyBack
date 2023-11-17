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

    public function add(Dessinateur $dessinateur, bool $flush = false): void
    {
        $this->getEntityManager()->persist($dessinateur);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findByName(string $name)
    {
        $query =$this->getEntityManager()->createQuery('SELECT d FROM '.Dessinateur::class.' d WHERE d.name=:name');
        $query->setParameter('name',$name);
        return $query->getResult();
    }

}
