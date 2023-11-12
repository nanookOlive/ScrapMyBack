<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameController extends AbstractController
{
    #[Route('/games', name: 'app_game')]
    public function index(GameRepository $gameRepo): Response
    {

        $allGames=$gameRepo->findAll();
        return $this->render('game/index.html.twig', [
            'allGames' => $allGames,
        ]);
    }
}
