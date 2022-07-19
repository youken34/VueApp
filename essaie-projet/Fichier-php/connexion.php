<?php

//header('content-type: application/json; charset=utf-8');
// Allow from any origin
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
  


$nom = filter_var($jsonContent->nom, FILTER_SANITIZE_STRING);
$prenom = filter_var($jsonContent->prenom, FILTER_SANITIZE_STRING);


$sql = new PDO ('mysql:host=localhost;dbname=essaie_js;charset=utf8', 'root', '');
$verif = $sql->prepare('SELECT * FROM authentification WHERE `nom` = :nom');
$verif->bindValue('nom', $nom);
$verif->execute();

if (!empty($nom) && !empty($prenom)) {
    if ($verif->rowCount() == 1) {
        $dataRow = $verif->fetch();
        if ($dataRow['prenom'] == $prenom) {
            $_SESSION['prenom'] = $prenom;
            $_SESSION['nom'] = $nom;
            $msg = "Connexion réussis";
            $success = true;
        }
        else {
            $msg =  "Prenom incorrect";
            $success = false;
        }
    }
    else {
        $msg =  "Identifiants incorrect";
        $success = false;
    }
}
else {
    $msg = "Veuillez remplir les champs";
    $success = false;
}

echo json_encode([
    'message' => $msg,
    'success' => $success,
    'nom' => $nom,
    'prenom' => $prenom
]
)
?>