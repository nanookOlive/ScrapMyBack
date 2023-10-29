<?php

namespace App\Controller;
use App\utils\Scrapy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        set_time_limit(0);
        $url='https://www.play-in.com/jeux_de_societe/recherche/?p=';
        $scrapy = new Scrapy('../docs/tmpFile.txt',$url);
        $array=$scrapy->getArrayGameName(100);
        return $this->render('main/index.html.twig',['data'=>$array]);
       
    }
}
