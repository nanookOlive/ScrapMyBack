<?php 

/**
 * 
 * on veut pouvoir renvoyer un objetr de type scrapy
 * avec un ensemble de méthodes 
 */
namespace App\utils;
use  App\Entity\Game;
use App\Entity\GameTmp;
use App\Repository\GameTmpRepository;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

//pour récupérer les genres d'un jeu preg => <div>(([$A-Za-zéèà-]+\s*)*)<\/div>
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

    public function __construct(string $tmpFile){

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
    
        //une fois sur la page de détail d'un jeu  on lance le crawler dédié

        function crawlerDetail(string $urlToScrap,string $name ){

            $this->browser->request('GET',$urlToScrap);//la ressource browser
            $contentPageString=($this->browser->getResponse())->getContent();
            file_put_contents($this->tmpFile,$contentPageString);
            //on récupére le contenu du txt sous la forme d'un tableau
            $arrayContent=file($this->tmpFile);

            $arrayResponse=[
                'nom'=>$name,
                'types'=>[],
                'themes'=>[],
                'editeur'=>'',
                'auteurs'=>[],
                'gamme'=>'',
                'dessinateurs'=>[],
                'duration'=>'',
                'nbJoueurs'=>['min'=>null,'max'=>null],
                'age'=>''
            ];

            $a=0;
            for($a=0;$a<count($arrayContent);$a++)
            {

                $line=$arrayContent[$a];
                // if(preg_match('/<div\sclass="tab\sbloc_tab\stab_desc\stab_selected"><h2>/',$line) || preg_match('/<a\shref="https:\/\/en.play-in.com\/produit\/\d+-\w+">/',$line)
                // ){
                
                //     $arrayResponse['nom']=$line;
                // }
                //si la line = durée
                if(preg_match('/^<th\sscope="row">Durée<\/th>/',$line)){

                    preg_match('/<div>(\d+)/',$arrayContent[$a+1],$matches);
                    $arrayResponse['duration']=$matches[1];

                }      
                //si la line = age
                if(preg_match('/^<a\shref="\/jeux_de_societe\/recherche\/\?age/',$line)){
                    $arrayResponse['age']="age found at $a";
                }                
                //si la line = nbJouers
                if(preg_match('/^<a\shref="\/jeux_de_societe\/recherche\/\?player/',$line)){
                    $arrayResponse['nbJoueurs']="nbJoueurFound at $a";
                }

                //si la line = type
                if(preg_match('/^<td\sclass="text"><a\shref="\/jeux_de_societe\/recherche\/\?type/',$line)){
                    if(empty($arrayResponse['types']))
                    {
                        //on crée le tableau des types
                        preg_match_all('/<div>((\w*[éà]*\s*)+)<\/div>/',$line,$arrayTypes);
                        foreach($arrayTypes[1] as $types){

                            array_push($arrayResponse['types'],$types);

                        }
                    }
                }
                //si la line = theme

                if(preg_match('/^<th\sscope="row">Thème\(s\)<\/th>$/',$line)){

                    if(empty($arrayResponse['themes'])){
                        array_push($arrayResponse['themes'],$arrayContent[$a+1]);
                    }
                }

                //si line = auteur
                if(preg_match('/^<th\sscope="row">Auteur\(s\)<\/th>$/',$line)){

                    if(empty($arrayResponse['auteurs']))
                        {
                            array_push($arrayResponse['auteurs'],$arrayContent[$a+1]."at line $a");
                        }                
                    }
                //si la line = editeur
                if(preg_match('/^<th\sscope="row">Éditeur\(s\)<\/th>$/',$line)){

                    preg_match_all('/>(\w*\s*[éèà]*)</',$arrayContent[$a+1],$matches);
                    $arrayResponse['editeur']=$matches[1][1];
                }
                //si la line = gamme

                if(preg_match('/^<th\sscope="row">Gamme<\/th>/',$line)){

                    $arrayResponse['gamme']=$line;
                }
                //si la line = dessinateur
                //j'ai eu une erreur quansd même 
                if(preg_match('/<th\sscope="row">Illustrateur\(s\)<\/th>/',$line)){

                    preg_match_all('/<div>((\w*[éèà]*\s*)+)/',$arrayContent[$a+1],$arrayDessinateurs);

                    for($gu=0;$gu<count($arrayDessinateurs[1]);$gu++){
                        
                        array_push($arrayResponse["dessinateurs"],$arrayDessinateurs[1][$gu]);

                    }
                    
                }
                
            
            }
            return $arrayResponse;
        }
        //renvoie un tableau avec dans l'ordre le href, le nom, description
    function getListGames(int $nbPagesToScrap,GameTmpRepository $repo) 
    {
        //mon tableau qui sera retourné

        $arrayResponse=[];

        for($gu=1;$gu<$nbPagesToScrap;$gu++){

            //on va chercher les noms des jeux sur nbPagesToScrap pages
            //on accede aux pages de ce site en particulier de la façon suivante
            //https://www.play-in.com/jeux_de_societe/recherche/?p=1, 2 etc ... 

            $urlToScrap=$this->url.$gu; // l'url de la page à scrap
            $this->browser->request('GET',$urlToScrap);//la ressource browser

            //on crée un objet Response en string

            $contentPageString=($this->browser->getResponse())->getContent();

        
            //on ecrit dans un txt le string retourné par la ligne précédente
            file_put_contents($this->tmpFile,$contentPageString);
            //on récupére le contenu du txt sous la forme d'un tableau
            $arrayContent=file($this->tmpFile);
            //id en attendant la db

            $a=0;

            
            while($a<count($arrayContent)){
                // récupération du nom du jeu
            $game = new GameTmp;

                while(is_null($game->getName())){
                    
                    

                    if($this->crawler($arrayContent[$a],"href")){

                        $href=$this->crawler($arrayContent[$a],"href");
                        $game->setHref($href);
                    
                        // if(is_null($game->getHref())){
                            
                        //    $game->setHref($href);
                        //     // array_push($arrayResponse,$href);

                        // }
                    }

                    if($this->crawler($arrayContent[$a],'name'))
                    {

                        $name=$this->crawler($arrayContent[$a], "name");
                        // array_push($arrayResponse,$name);
                        $game->setName($name);
                        
                    }

                    $a++;
                    if($a >= count($arrayContent)){
                        break;
                    }
                }

                $game->setId($a);
                $game->setDescription('blabla');

                if(!is_null($game->getName()) && !is_null($game->getHref()) ){

                    $repo->add($game,true);
                }
           

            }
              

                
        }

        return $arrayResponse;
            
    }

        
   
// une méthode pour assigner dans un tableau des objets gameTmp
// avec les champs nom,href,description 
//visiblement un champs peut manquer 
    // function getGameTmpArray(int $nbPagesToScrap):array{

    //     $data=$this->getInfoGame($nbPagesToScrap);
    //     $arrayTmpGame=[];
    //     $a=0;
    //     while($a < count($data)){
            
    //         while(!preg_match('/^\//',$data[$a])){
    //             $a++;
    //             if($a>= count($data)){
    //                 break;
    //             }
    //         }
    //         $tmpGame=new GameTmp;
    //         $tmpGame->setId($a);
    //         $tmpGame->setHref($data[$a]);
    //         $tmpGame->setName($data[$a+1]);
    //         $tmpGame->setDescription($data[$a+2]);
    //         array_push($arrayTmpGame,$tmpGame);
    //         $a += 3;
    //     }

    //     return $arrayTmpGame;
    // }

}