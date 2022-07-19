<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
        // We have to check if the origin in $_SERVER['HTTP_ORIGIN'] is an allowed origin.
        // If it is the case, we add the relevant header with lines bellow.
        //if($_SERVER['HTTP_ORIGIN'])=="https://www.gsb.best"
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // We have here to list all http method allowed for ajax calls.
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }


session_start();

$jsonContent = json_decode(file_get_contents("php://input"));

$prenom = (!empty($jsonContent->prenom)) ? filter_var($jsonContent->prenom, FILTER_SANITIZE_STRING) : "Jewi";


$sql = new PDO ('mysql:host=localhost;dbname=essaie_js;charset=utf8', 'root', '');

 
$queryImg = $sql->prepare("SELECT i.image, a.prenom, a.nom, a.id
                FROM image i
                INNER JOIN authentification a 
                ON i.id_authentification = a.id
                WHERE a.prenom != :prenom
                ORDER BY a.id DESC
                ,RAND()
        ");
$queryImg->bindValue('prenom', $prenom);
$queryImg->execute();


$fetching2 = $queryImg->fetchAll();

$tableauImage [] = array();

foreach ($fetching2 as $key) {
        $tableauImage [] = array(
             'image' =>  explode("www", $key['image']),
             'nom' => $key['nom'],
             'prenom' => $key['prenom'],
             "id" => $key['id'],
        );
}
$TAB = array();
$TAB2 = array();
$x = 1;

        for ($i=1; $i < count($tableauImage) ; $i++) { 
                $TAB[$i] = array(
                "image" => $tableauImage[$i]['image'][1],
                'nom' => $tableauImage[$i]['nom'],
                'prenom' => $tableauImage[$i]['prenom'],
                'id' => $tableauImage[$i]['id'],

                );
        }

        for ($i=0; $i < count($TAB); $i++) { 
                
               $TAB2[$i] = array(
               'lien' => str_ireplace("\\", "/", $TAB[$x]['image']),
                'nom' => $TAB[$x]['nom'],
                'prenom' => $TAB[$x]['prenom'],
                'id' => $TAB[$x]['id'],

               );
               // Découper la chaine de caractères pour la formater 
               $x++;
        }


echo json_encode($TAB2);


