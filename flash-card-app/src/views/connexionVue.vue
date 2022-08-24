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
    <div class="center" v-show="afficher == true">
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
</style>
