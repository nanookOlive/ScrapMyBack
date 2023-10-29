<?php 

/**
 * 
 * on veut pouvoir renvoyer un objetr de type scrapy
 * avec un ensemble de méthodes 
 */
namespace App\utils;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
require_once 'vendor/autoload.php';


class Scrapy{

    private $tmpFile;
    private $url;
    private $browser;
    private $gameArray;
    private $formats=array(
        'name'=>['line'=>'/class="name_product"/','itemInLine'=>'/>((\w+\s*\W*)+)</'],
        'duration'=>[],
        'shortDescription'=>[],
        'nbPlayers'=>[]      
    );

    public function __construct(string $tmpFile, string $url){

        $this->url=$url;
        $this->tmpFile=$tmpFile;
        $this->browser=new HttpBrowser(HttpClient::create());
        $this->gameArray=[];

    }

    //va renvoyer les informations de chaque ligne correspondante
    //critères preg

    public function crawler(string $rowt, string $needle): ?string 
    {

            if(preg_match($formats[$needle]['line'],$row)){

                preg_match($formats[$needle]['itemInLine'],$row,$matches);
                return $matches[1];
                
            }
            else{
                
                false;
            }

        }
}

//qq variable
$url='https://www.play-in.com/jeux_de_societe/recherche/?p=';


function returnArrayNameGame(int $nbPagesToScrap, string $url, $browser):array 
{

    //mon tableau qui sera retourné

    $arrayResponse=[];

    for($a=1;$a<$nbPagesToScrap;$a++){

        //on va chercher les noms des jeux sur n pages
        //on accede aux pages du site via un numéro de page 
        //https://www.play-in.com/jeux_de_societe/recherche/?p=1, 2 etc ... 

        $this->url=$this->$url.$a;
        $this->browser->request('GET',$urlToScrap);

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

       
        //on affiche tous les noms des jeux
       

    }

    return $arrayResponse;


}


