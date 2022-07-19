<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Fichier css/style.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3.2.33/dist/vue.global.js"></script>

</head>

<body>

<div class="container">
<div class="banner">

</div>

<div class="flexible">
        
        <?php if (!empty($_SESSION['prenom']) && !empty($_SESSION['nom'])) {
            echo "<div class='id card-left'>";
            echo $_SESSION['prenom'] . "<br> <br>" .
            $_SESSION['nom'];
            echo " </div>";
        }
        ?>
       
        

    

    <div class="center" id="app">

        <div v-if="clicked == false" class="card center">
            <p class="textValue" v-text="defaultValue"> </p>
            <button class="boutton" type="button" @click="getData"></button>
        </div>
        
        <div v-else class="card center"  :style="{'background-image': 'url(' + ReturnImage + ')'}">
            <div class="flexible">
            <p class="dataProfil" v-text="nom"></p>
            <p class="dataProfil" v-text="prenom"></p>
            <br>
        </div>
            <div class="center stickBottom">
                <br>
                <button class="boutton1 center" type="button" @click="move(-1)">&#8592</button>
                <button class="boutton2 center" type="button" @click="move(1)">&#8594</button>
            </div>
        </div>
    
        </div>

        <div class="id card-right">
            <form action="http://localhost:3000/Essaie-projet/Fichier-php/deconnexion.php">
        <button class="button-left" type="submit">Deconnexion</button> <br> <br>
            </form>
            <form action="http://localhost:3000/Essaie-projet/Fichier-html/connexion.html">
        <button class="button-left" type="submit">Connexion</button> <br> <br>
            </form>
            <form action="http://localhost:3000/Essaie-projet/Fichier-html/formulaireInscription.html">
        <button class="button-left" type="submit">Inscription</button>
            </form>
        </div>
    </div>
    <div class="footer">

    </div>
 </div>






    <script>
        const view = {
            data() {
                return {
                    posts: "Charger des données",
                    index: 0,
                    clicked: false,
                    host: "http://localhost/",


                }
            },
            methods: {
                getData() {
                    axios.get("http://localhost:3000/Essaie-projet/Fichier-php/query.php")
                        .then(response => this.posts = response.data,
                        // response => this.nom = response.data.nom,
                        // response => this.prenom = response.data.prenom,
                        )
                        .then(console.log(this.posts))
                        .then(this.clicked = true);
                  
                        // .then(console.log(this.posts))
                        // .then(console.log(this.nom));
                    // La méthode axios nous disponse d'utiliser JSON.stringify
                },
                move(change) {

                        this.index += change;
                },
               

            },
            computed: {
                nom() {
                    return this.posts[this.index].nom;
                },
                defaultValue() {
                    return this.posts;

                },
                prenom() {
                    return this.posts[this.index].prenom;
                },
                ReturnImage() {
                    if (this.posts[this.index].lien) {
                        return this.host  + this.posts[this.index].lien;
                    }
                        
                    
                    
                }
            }

        };
        const review = Vue.createApp(view).mount('#app')

    </script>


</body>

</html>