<!--  eslint-disable vue/no-parsing-error  -->
<template>


<section ref="alert" class="message error" v-show="afficherErreur == true">
      <header></header>
      <i></i>
      <h2>
        <span>Erreur !</span>
        Vous n'êtes pas connecté
      </h2>
      <button class="boutonRedirection" @click="redirection()">
        Se connecter
      </button>
    </section>
 <body v-show="this.Prenom"> <!-- Cette condition permet à la page de ne pas s'afficher si on y accède sans être connécté -->

<div class="container" ref="container">
<div class="banner">

</div>

<div class="flexible taille" >      
    <div class="card-left"  ref="left" @mouseover="menuOpen" @mouseleave="menuClosed">
            <div class='flexible'>
            <p class="textValue"> Bonjour</p>
            <p class="idUser"> <strong> {{Prenom}} </strong> </p>
            </div>
            <div class="column">
            <a href="" ref="param">Paramètre</a>
            <a href="" ref="profil">Mon profil</a>
            <a href="" ref="securité">Sécurité</a>
            </div>
            </div>
                <div class='stars' ref='stars'></div>

    <div class="center" ref="centre" id="app">

        <div class="card"  :style="{'background-image': 'url(' + ReturnImage + ')'}">
            <div class="flexible">
            <p class="dataProfil" v-text="nom"></p>
            <p class="dataProfil" v-text="prenom"></p>
            <br>
        </div>
            <div class="space center stickBottom">  
                <button class="boutton1 center" type="button" @click="move(-1)">&#8592</button>
                <button class="boutton2 center" type="button" @click="move(1)">&#8594</button>
                <br>
                <button class="boutton4"  @click.stop="dislike(this.posts[this.index].id)" type="button">&#10060</button> 
                 <button class="boutton3"  @click.stop="like()" type="button">&#10084</button> 
            </div>
        </div>
        </div>

        <div class="card-right column">
            <button class="button-left" @click="deconnexion()">Déconnexion </button>          
            <router-link  class="button-left" to="/Inscription">Inscription</router-link>
        </div>
    </div>
    <div class="footer">
    </div>
 </div>
</body>

</template>

<script>
import axios from 'axios';
// import { count } from 'console';


        export default{

            data() {
                return {
                    posts: "Charger des données",
                    index: 0,
                    host: "http://localhost/",
                    Prenom: sessionStorage.getItem('Personne-connécté'),
                    tableau: [],
                    afficherErreur: false,

                }
            },
            created() {
                //this.Prenom = this.$route.params.Prenom
            },

            mounted() {
               if (!this.Prenom) {
                        this.afficherErreur = true  
                        document.body.style.backgroundColor = "#676767";
                        this.$refs.alert.style.backgroundColor = "#676767";
                    }
                axios.post("http://localhost:3000/essaie-projet/Fichier-php/query.php",
                    {
                        prenom: this.Prenom,
                    }
                    )
                        .then(response => this.posts = response.data,
                        )
                    // La méthode axios nous dispense d'utiliser JSON.stringify
                     for (let index = 0; index < 20; index++) {
                this.$refs.stars.insertAdjacentHTML("afterbegin", " <div class='star'></div>");  
                    }
            },
            updated() {
                
            },
            watch: {

            },
            methods: {
                redirection(){
                    document.body.style.backgroundColor = "#FFFFFF";
                    this.$router.push({name: 'Connexion'})
                },
                menuOpen() {
                    let left = this.$refs.left
                    let param = this.$refs.param
                    let profil = this.$refs.profil
                    let securité = this.$refs.securité
                        param.style.transitionDuration = "1.25s";
                        param.style.transitionDelay = "0.9s";
                        profil.style.transitionDuration = "1.25s";
                        profil.style.transitionDelay = "1.2s";
                        securité.style.transitionDuration = "1.25s";
                        securité.style.transitionDelay = "1.5s";
                        param.style.opacity = 1;
                        profil.style.opacity = 1;
                        securité.style.opacity = 1;
                        left.style.transitionDuration = "1.5s";
                        left.style.width = '300px';
                    
                },
                menuClosed() {
                    let left = this.$refs.left
                    let param = this.$refs.param
                    let profil = this.$refs.profil
                    let securité = this.$refs.securité
                        param.style.transitionDuration = "0s";
                        param.style.transitionDelay = "0s";
                        profil.style.transitionDuration = "0s";
                        profil.style.transitionDelay = "0s";
                        securité.style.transitionDuration = "0s";
                        securité.style.transitionDelay = "0s";
                        param.style.opacity = 0;
                        profil.style.opacity = 0;
                        securité.style.opacity = 0;
                        left.style.width = '200px';
                },
                move(change) {
                    console.log(this.posts[this.index].id.length)
                    if (this.index + change <= this.posts.length - 1 &&
                        this.index + change >= 0) {
                            if (this.posts[this.index + change].nom === this.posts[this.index].nom) {
                                this.index += change;
                            }
                        }  
                },
               like(change) {
                   if (this.index + change <= this.posts.length - 1 &&
                        this.index + change >= 0) {
                          this.index += change;
                    }
               },
              dislike(){
                     this.tableau.push(this.posts[this.index].id)
                   if (this.posts.length > this.posts[this.index].id.length - 1 ) {
                        localStorage.setItem(this.Prenom, JSON.stringify(this.tableau))
                       this.posts.splice(this.index,  this.posts[this.index].id.length - 1)

                   }
                
               },
              deconnexion(){
                 sessionStorage.removeItem("Personne-connécté")
                 this.$router.push({name: 'Connexion'})
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
                // eslint-disable-next-line vue/return-in-computed-property
                ReturnImage() {
                    if (this.posts[this.index].lien) {
                        return this.host  + this.posts[this.index].lien;
                    }                   
                },
             
            }

        };

    </script>


<style  lang="scss" scoped>
@import '@../../../essaie-projet/fichier-css/global.scss';
@import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");

@import url("https://use.fontawesome.com/releases/v5.8.1/css/all.css");

$default: #9e9e9e;
$error: #d50000;
$warning: #ff6f00;
$neutral: #448aff;
$success: #388e3c;
$uhm: #c1610d;

$light: #eee;
$dark: #222;

// *,
// *:after,
// *:before {
//   box-sizing: border-box;
// }

.boutonRedirection {
  width: 100%;
  margin-bottom: 0px;
  background-color: #ff6969;
  // border-radius: 1em;
  border: none;
  font-size: 1.25em;
  position: relative;
  display: block;

}

.boutonRedirection:hover {
  background-color: rgb(215, 215, 215);
  color: #ffffff;
}
.message {
  position: absolute;
  left: 520px;
  top: 200px;
  background: $light;
  box-shadow: 4px 4px 8px 0px rgba(0, 0, 0, 0.31);
  border-radius: 1em;
  overflow: hidden;
  display: flex;
  flex-wrap: wrap;
  width: 500px;
  height: 140px;
  margin: 2em auto;

  button {
    font-size: 20px;
  }

  i:after {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f128";
    font-style: normal;
    color: $light;
    background: mix($dark, $default, 85%);
    padding: 1em 0.75em;
    font-size: 1.25em;
    display: block;
    width: 3.5em;
    height: 100%;
    text-align: center;
    box-sizing: border-box;
    
  }

  h2 {
    margin: 0.75em;
    font-size: 1.25em;
    position: relative;
     display: block;
    width: calc(100% - 3.5em - 1.5em);

    span {
      color: $default;
    }

    &:after {
      content: "";
      border-bottom: 0.1em solid $default;
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
    }
  }
}

.error {
  header {
    background: $error;
  }

  i:after {
    background: mix($dark, $error, 85%);
    color: lighten($error, 25%);
    content: "\f12a";
  }

  h2 {
    span {
      color: $error;
    }

    &:after {
      border-bottom: 0.1em solid $error;
    }
  }
}

.warning {
  header {
    background: $warning;
  }

  i:after {
    background: mix($dark, $warning, 85%);
    color: lighten($warning, 25%);
    content: "\f071";
  }

  h2 {
    span {
      color: $warning;
    }

    &:after {
      border-bottom: 0.1em solid $warning;
    }
  }
}

.neutral {
  header {
    background: $neutral;
  }

  i:after {
    background: mix($dark, $neutral, 85%);
    color: lighten($neutral, 25%);
    content: "\f05a";
  }

  h2 {
    span {
      color: $neutral;
    }

    &:after {
      border-bottom: 0.1em solid $neutral;
    }
  }
}

.success {
  header {
    background: $success;
  }

  i:after {
    background: mix($dark, $success, 85%);
    color: lighten($success, 25%);
    content: "\f058";
  }

  h2 {
    span {
      color: $success;
    }

    &:after {
      border-bottom: 0.1em solid $success;
    }
  }
}

.uhm {
  header {
    background: $uhm;
  }

  i:after {
    background: mix($dark, $uhm, 85%);
    color: lighten($uhm, 25%);
    content: "\f2fe";
  }

  h2 {
    span {
      color: $uhm;
    }

    &:after {
      border-bottom: 0.1em solid $uhm;
    }
  }
}
</style>