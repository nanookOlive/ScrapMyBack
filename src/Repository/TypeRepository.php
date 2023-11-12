<?php

namespace App\Repository;

use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Type>
 *
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function add(Type $type, bool $flush = false): void
    {
        $this->getEntityManager()->persist($type);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByName(string $name)
    {
        $query =$this->getEntityManager()->createQuery("SELECT t FROM ".Type::class." t WHERE t.name='$name'");
        return $query->getResult();
    }
}
