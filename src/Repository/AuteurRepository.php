<?php

namespace App\Repository;

use App\Entity\Auteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Auteur>
 *
 * @method Auteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteur[]    findAll()
 * @method Auteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteur::class);
    }

    public function add(Auteur $auteur, bool $flush = false): void
    {
        $this->getEntityManager()->persist($auteur);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByName(string $name)
    {
        $query =$this->getEntityManager()->createQuery("SELECT a FROM ".Auteur::class." a WHERE a.name='$name'");
        return $query->getResult();
    }

}
