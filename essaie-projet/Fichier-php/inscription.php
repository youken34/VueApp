<?php   

        $ret        = false;
        $img_blob   = '';
        $img_taille = 0;
        $img_type   = '';
        $img_nom    = '';
        $taille_max = 250000;
        try {
            $ret = is_uploaded_file($_FILES['image']['tmp_name']);
        if (!$ret) {
            echo "Problème de transfert";
            return false;
        } else {
            //echo "Le fichier a bien été reçu";
            $img_taille = $_FILES['image']['size'];
        }
            if ($img_taille > $taille_max) {
                echo "Trop gros !";
                return false;
            }
        }  
         catch (\Throwable $th) {
            die("Erreur : " . $th->getMessage());
        }
        
            $img_type = $_FILES['image']['type'];
            $img_nom  = $_FILES['image']['name'];

            $img_blob = file_get_contents ($_FILES['image']['tmp_name']); 

            // tmp_name est la valeur de l'image sous forme de texte (chiffré)

            $nom =  $_POST['prenom'];
            $prenom =  $_POST['nom'];
            $mail =  $_POST['mail'];

            $name = $_FILES["image"]["name"];
            $lienDossier = "C:\wamp64\www\Lien-image-Sql";
            move_uploaded_file($_FILES["image"]["tmp_name"], "$lienDossier/$name");
            $lien = "$lienDossier\\$name";
            echo $lien;


            $sql = new PDO ('mysql:host=localhost;dbname=essaie_js;charset=utf8', 'root', '');

            $query3 = $sql->prepare("SELECT id FROM authentification WHERE `nom` = :nom");
            $query3->bindValue('nom', $nom);
            $query3->execute();
            $fetchId = $query3->fetch();
            
            if ($query3->rowCount() != 1) {
                $query = $sql->prepare("INSERT INTO authentification (nom, prenom, mail) VALUES (?, ?, ?)");
                $query->execute(array($nom, $prenom, $mail));

                $query2 = $sql->prepare("INSERT INTO image (image, id_authentification) VALUES (?, ?)");
                $query2->execute(array($lien, $fetchId['id']));
            }

            
        
    
        

?>