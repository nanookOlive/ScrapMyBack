<?php 

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

require_once 'vendor/autoload.php';
//qq variable
$url='https://www.play-in.com/jeux_de_societe/recherche/?p=';
$browser=new HttpBrowser(HttpClient::create());

function returnArrayNameGame(int $nbPagesToScrap, string $url, $browser):array 
{

    //mon tableau qui sera retourné

    $arrayResponse=[];

    for($a=1;$a<$nbPagesToScrap;$a++){

        //on va chercher les noms des jeux sur n pages
        //on accede aux pages du site via un numéro de page 
        //https://www.play-in.com/jeux_de_societe/recherche/?p=1, 2 etc ... 

        $urlToScrap=$url.$a;
        $browser->request('GET',$urlToScrap);

        //on crée un objet Response

        $contentPage = $browser->getResponse();

        //Récupération des infos sous la forme d'une string
        // l'objet Response dispose des méthode getContent(), getStatusCode(),getHeaders(),getHeader(),toArray()


        $contentPageString=$contentPage->getContent();

        //on ecrit dans un txt le string retourné par la ligne précédente
        file_put_contents('content.txt',$contentPageString);
        //on récupére le contenu du txt sous la forme d'un tableau
        $arrayContent=file('content.txt');

        //on cherche ici à récupérer les noms des jeux 
        //"<div class="name_product" title="Akropolis">Akropolis</div>

        //le pattern pour la regex
        $formatLineGame='/class="name_product"/';
        $formatGameName = '/>((\w+\s*\W*)+)</';

        //on affiche tous les noms des jeux
        foreach($arrayContent as $row){

            if(preg_match($formatLineGame,$row)){
                preg_match($formatGameName,$row,$matches);
                dump($matches[1]);
                //array_push($arrayResponse,$matches[1]);
            }


        }

    }

    return $arrayResponse;


}


dump(returnArrayNameGame(100,$url,$browser));
