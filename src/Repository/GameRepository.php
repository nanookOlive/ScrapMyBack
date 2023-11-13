<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 *
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }


    public function add(Game $game, bool $flush = false): void
    {
        $this->getEntityManager()->persist($game);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //requete opti pour avoir un jeu avec l'ensemble de ses relations 

    public function findGameAllData(Game $game) {

        $queryBuilder=$this->createQueryBuilder('game');

        return $queryBuilder->andWhere('game =:game')
        ->setParameter('game',$game)
        ->join('game.auteurs','auteurs')
        ->join('game.dessinateurs','dessinateurs')
        ->join('game.types','types')
        ->join('game.themes','themes')
        ->addSelect('auteurs')
        ->addSelect('dessinateurs')
        ->addSelect('types')
        ->addSelect('themes')
        ->getQuery()
        ->getSingleResult();
    }
}
