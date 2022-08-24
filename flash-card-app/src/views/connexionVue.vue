<template>
  <router-link to="/PageTest" v-show="afficher == true"
    >Page de Test</router-link>
  <body>
    <section ref="alert" class="message error" v-show="afficherErreur == true">
      <header></header>
      <i></i>
      <h2>
        <span>Erreur !</span>
        Vous êtes déjà connectez
      </h2>
      <button class="boutonRedirection" @click="redirection()">
        Revenir à l'accueil
      </button>
    </section>
    <div class="center">
    <div class="form" v-show="afficher == true">
      <router-link to="/Inscription">Inscription</router-link>

      <div class="title">Connexion</div>
      <div class="subtitle">Connectez-vous</div>
      <div class="input-container ic1">
        <input
          id="firstname"
          class="input"
          type="text"
          placeholder=" "
          name="prenom"
          v-model="prenom"
        />
        <div class="cut"></div>
        <label for="firstname" class="placeholder">Prénom</label>
      </div>
      <div class="input-container ic2">
        <input
          id="lastname"
          class="input"
          type="text"
          placeholder=" "
          name="nom"
          v-model="nom"
        />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Nom</label>
      </div>

      <button class="submitConnexion" @click="connexion()">Envoyez</button>
      <!-- </form> -->
    </div>
    </div>
  </body>
</template>

<script>
// On va utiliser ça pour exporter notre composant en tant que module
import axios from "axios";
export default {
  name: "connexionVue",
  props: [],
  data() {
    return {
      idConnexion: [],
      prenom: "",
      nom: "",
      afficher: true,
      afficherErreur: false,
    };
  },
  mounted() {
    if (sessionStorage.getItem("Personne-connécté")) {
      this.afficherErreur = true;
      this.afficher = false;
      document.body.style.backgroundColor = "#676767";
    }
  },

  methods: {
    connexion() {
      axios
        .post("http://localhost:3000/essaie-projet/Fichier-php/connexion.php", {
          nom: this.nom,
          prenom: this.prenom,
        })
        .then((response) => (this.idConnexion = response.data));

      if (this.idConnexion.success === true) {
        sessionStorage.setItem("Personne-connécté", this.idConnexion.prenom);
        this.$router.push({
          name: "Accueil",
          params: { Prenom: this.idConnexion.prenom },
        });
      }
    },
    redirection() {
      this.$router.push({ name: "Accueil" });
      document.body.style.backgroundColor = "#FFFFFF";
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@../../../essaie-projet/fichier-css/global.scss";


@import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");

@import url("https://use.fontawesome.com/releases/v5.8.1/css/all.css");

$default:#9E9E9E;
$error:#D50000;
$warning:#FF6F00;
$neutral:#448AFF;
$success:#388E3C;
$uhm:#c1610d;

$light:#eee;
$dark:#222;

.center {
  align-items: center;
    // background-color: #000;
    background-color: #FFFF;
    display: flex;
    justify-content: center;
    height: 100vh;
}

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

.message{
  background:$light;
  box-shadow: 4px 4px 8px 0px rgba(0,0,0,0.31);
  border-radius:1em;
  overflow:hidden;
  display:flex;
  flex-wrap:wrap;
  width: 500px;
  height: 130px;
  margin:2em auto;
 
  
  i:after{
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900; 
    content:'\f128';
    font-style:normal;
    color:$light;
    background:mix($dark, $default, 85%);
    padding:1em .75em;
    font-size:1.25em;
    display:block;
    width:2.5em;
    height:100%;
    text-align:center;
    box-sizing: border-box;
  }
  
  h2{
    margin:.75em;
    font-size:1.25em;
    position:relative;
    display:block;
    width:calc(100% - 2.5em - 1.5em);
    
    span {
      color:$default;
    }
    
    &:after {
      content:'';
      border-bottom:.1em solid $default;
      width:100%;
      height:100%;
      position: absolute;
      top: 0;
      left: 0;
    }
  }
}

.error {
  header {
    background:$error;
  }
  
  i:after{
    background:mix($dark, $error, 85%);
    color:lighten($error, 25%);
    content: "\f12a";
  }
  
  h2 {
    span {
      color:$error;
    }
  
    &:after {
      border-bottom:.1em solid $error;
    }
  }
}

.warning {
  header {
    background:$warning;
  }
  
  i:after{
    background:mix($dark, $warning, 85%);
    color:lighten($warning, 25%);
    content: "\f071";
  }
  
  h2 {
    span {
      color:$warning;
    }
  
    &:after {
      border-bottom:.1em solid $warning;
    }
  }
}

.neutral {
  header {
    background:$neutral;
  }
  
  i:after{
    background:mix($dark, $neutral, 85%);
    color:lighten($neutral, 25%);
    content: "\f05a";
  }
  
  h2 {
    span {
      color:$neutral;
    }
  
    &:after {
      border-bottom:.1em solid $neutral;
    }
  }
}

.success {
  header {
    background:$success;
  }
  
  i:after{
    background:mix($dark, $success, 85%);
    color:lighten($success, 25%);
    content: "\f058";
  }
  
  h2 {
    span {
      color:$success;
    }
  
    &:after {
      border-bottom:.1em solid $success;
    }
  }
}

.uhm {
  header {
    background:$uhm;
  }
  
  i:after{
    background:mix($dark, $uhm, 85%);
    color:lighten($uhm, 25%);
    content: "\f2fe";
  }
  
  h2 {
    span {
      color:$uhm;
    }
  
    &:after {
      border-bottom:.1em solid $uhm;
    }
  }
}

</style>
