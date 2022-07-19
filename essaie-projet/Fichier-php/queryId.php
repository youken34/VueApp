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
        $sql = new PDO ('mysql:host=localhost;dbname=essaie_js;charset=utf8', 'root', '');
        $query = $sql->prepare("SELECT `nom`, `prenom`
        FROM `authentification`
        WHERE `prenom` != :prenom
        ORDER BY RAND() 
        LIMIT 5 
        ");
        $query->bindValue('prenom', $_SESSION['prenom']);
        $query->execute();
        
        
$fetching = $query->fetchAll();


echo json_encode($fetching);


?>