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

    public function crawler(string $row,string $needle)
    {


            if(preg_match($this->formats[$needle]['line'],$row)){

                preg_match($this->formats[$needle]['itemInLine'],$row,$matches);
                if(isset($matches[1])){
                    
                    return $matches[1];
                }
                
            }
            else{
                
                false;
            }

   
        }

    function getArrayGameName(int $nbPagesToScrap) 
    {

        //mon tableau qui sera retourné

        $arrayResponse=[];

        for($a=1;$a<$nbPagesToScrap;$a++){

            //on va chercher les noms des jeux sur nbPagesToScrap pages
            //on accede aux pages de ce site en particulier de la façon suivante
            //https://www.play-in.com/jeux_de_societe/recherche/?p=1, 2 etc ... 

            $urlToScrap=$this->url.$a; // l'url de la page à scrap
            $this->browser->request('GET',$urlToScrap);//la ressource browser

            //on crée un objet Response en string

            $contentPageString=($this->browser->getResponse())->getContent();

        
            //on ecrit dans un txt le string retourné par la ligne précédente
            file_put_contents($this->tmpFile,$contentPageString);
            //on récupére le contenu du txt sous la forme d'un tableau
            $arrayContent=file($this->tmpFile);

            foreach($arrayContent as $line){

                
              if($this->crawler($line,'name')){
                array_push($arrayResponse,$this->crawler($line,'name'));
              }


            }

            
        }

        
    return $arrayResponse;

    }


}
