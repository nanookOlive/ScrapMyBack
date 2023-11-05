<?php

namespace App\Controller;
use App\utils\Scrapy;
use App\Repository\GameTmpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class MainController extends AbstractController
{
    //méthode qui affiche l'ensemble des jeux temporaires disponibles désormais en base 
    #[Route('/', name: 'app_main')]
    public function index(ManagerRegistry $manager,GameTmpRepository $gameRepo): Response
    {
        
        
        $arrayGameTmp=$gameRepo->findAll();
        return $this->render("main/index.html.twig",["data"=>$arrayGameTmp]);
       
    }

    //méthode qui va afficher le détai d'un jeux
    #[Route("/show/{id}",name: "app_show")]

    public function show($id,ManagerRegistry $manager,GameTmpRepository $gameRepo){
        set_time_limit(0);//le temps de passé à rercher peut être long
        //on veut éviter de le processus s'arreter avant la fin de la recherche
        $game=$gameRepo->find($id);
        $scrapy=new Scrapy("../docs/tmpFile.txt");
        $data=$scrapy->crawlerDetail("https://www.play-in.com".$game->getHref(),$game->getName());
        dd($data);
        return $this->render("main/show.html.twig");
    }
}
