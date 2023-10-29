<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {

        $str='<div class="name_product" title="Focus">Focus</div>';
        $formats=array(
            'name'=>['line'=>'/class="name_product"/','itemInLine'=>'/>((\w+\s*\W*)+)</'],
            'duration'=>[],
            'shortDescription'=>[],
            'nbPlayers'=>[]      
        );preg_match($formats['name']['itemInLine'],$str,$matches);
        dump($matches);
    }
}
