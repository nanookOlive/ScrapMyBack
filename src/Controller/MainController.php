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
    public function index(GameTmpRepository $gameRepo): Response
    {
    
        $arrayGameTmp=$gameRepo->findAll();
        return $this->render("main/index.html.twig",["data"=>$arrayGameTmp]);
       
    }

    //méthode qui va afficher le détai d'un jeux
    #[Route("/scrapyDo",name: "app_scrapyDo")]
    public function show(Scrapy $scrapy,GameTmpRepository $gameRepo){


        set_time_limit(0);//le temps de passé à rercher peut être long
        //on veut éviter de le processus s'arreter avant la fin de la recherche
        $arrayGameTmp=$gameRepo->findAll();

        foreach($arrayGameTmp as $gameTmp){

                $game=$scrapy->crawlerDetail($gameTmp);

        }
       
        return $this->render("main/resultat.html.twig");
    }

    //route qui va créer un ensemble de jeux temporaires en base de données
    //ils n'ont que deux champs leur nom et l'url qui amène sur la page de détail d'un sur le site play in
    //on peut décider du nombre de pages qui seront scrapper
    #[Route('/create',name:'app_init_db')]
    public function create(Scrapy $scrapy){
        
        $scrapy->getListGames(20);
        return $this->redirectToRoute('app_main');

    }
    #[Route("/base/show/{id}",name:'app_base_show')]
    public function showBase(Game $game,GameRepository $gameRepo){
        //$gameFound=$gameRepo->find($game->getId());

        $gameFound=$gameRepo->findGameAllData($game);

        return $this->render("main/show.html.twig",['data'=>$gameFound]);

    }
}
