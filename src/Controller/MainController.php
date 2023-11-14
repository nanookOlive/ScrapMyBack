<?php

namespace App\Controller;
use App\Entity\Game;
use App\Entity\GameTmp;
use App\Controller\Scrapy;
use App\Repository\GameRepository;
use App\Repository\GameTmpRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    //méthode qui affiche l'ensemble des jeux temporaires disponibles désormais en base 
    #[Route('/', name: 'app_main')]
    public function index(GameRepository $gameRepo): Response
    {
    
        $arrayGameTmp=$gameRepo->findAll();
        return $this->render("main/index.html.twig",["data"=>$arrayGameTmp]);
       
    }


    #[Route("/show/{id}",name:'app_base_show')]
    public function showBase(Game $game,GameRepository $gameRepo){

        $gameFound=$gameRepo->findGameAllData($game);

        return $this->render("main/show.html.twig",['data'=>$gameFound]);

    }

  
}
