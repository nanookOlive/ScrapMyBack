<?php 

/**
 * 
 * on veut pouvoir renvoyer un objetr de type scrapy
 * avec un ensemble de méthodes 
 */
namespace App\utils;
use  App\Entity\Game;
use App\Entity\GameTmp;
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
        'shortDescription'=>['line'=>'/class="desc_short"/','itemInLine'=>'/>((\w+\s*\W*)+)</'],
        'nbPlayers'=>[],
        'blockGame'=>['line'=>'/class="container_info/'],
        'href'=>["line"=>'/^<a\shref="\/produit\/\d+/',"itemInLine"=>'/"(.*)"/']  
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
        //renvoie un tableau avec dans l'ordre le href, le nom, description
    function getInfoGame(int $nbPagesToScrap) 
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
                // récupération du nom du jeu
              if($this->crawler($line,'name')){

                $name=$this->crawler($line, "name");
                array_push($arrayResponse,$name);
              }

              //ajout de l'url du détail du jeu
              if($this->crawler($line,"href")){

                $href=$this->crawler($line,"href");
                if(! in_array($href,$arrayResponse)){
                    array_push($arrayResponse,$href);

                }
              }

              if($this->crawler($line,"shortDescription")){

                $description=$this->crawler($line,'shortDescription');
                array_push($arrayResponse,$description);

              }


            }

            
        }

        
    return $arrayResponse;

    }
// une méthode pour assigner dans un tableau des objets gameTmp
// avec les champs nom,href,description 
//visiblement un champs peut manquer 
function getGameTmpArray(int $nbPagesToScrap){

    $data=$this->getInfoGame($nbPagesToScrap);
    $arrayTmpGame=[];
    $a=0;
    while($a < count($data)){
        
        while(!preg_match('/^\//',$data[$a])){
            $a++;
        }
        $tmpGame=new GameTmp;
        $tmpGame->setHref($data[$a]);
        $tmpGame->setName($data[$a+1]);
        $tmpGame->setDescription($data[$a+2]);
        array_push($arrayTmpGame,$tmpGame);
        $a += 3;
    }

    return $arrayTmpGame;
}

}
