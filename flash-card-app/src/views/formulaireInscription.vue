<template>
  <router-link to="/PageTest" v-show="afficher == true"
    >Page de Test</router-link>
    <body>
     <section ref="alert" class="message error" v-if="afficherErreur == true">
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
      <router-link to="/">Connexion</router-link>
      <br />
      <form
        enctype="multipart/form-data"
        action="http://localhost:3000/essaie-projet/Fichier-php/inscription.php"
        method="POST">
        <div class="title">Welcome</div>
        <div class="input-container ic1">
          <input
            id="firstname"
            class="input"
            type="text"
            placeholder=" "
            name="prenom"
          />
          <div class="cut"></div>
          <label for="firstname" class="placeholder">First name</label>
        </div>
        <div class="input-container ic2">
          <input
            id="lastname"
            class="input"
            type="text"
            placeholder=" "
            name="nom"
          />
          <div class="cut"></div>
          <label for="lastname" class="placeholder">Last name</label>
        </div>
        <div class="input-container ic2">
          <input
            id="email"
            class="input"
            type="text"
            placeholder=" "
            name="mail"
          />
          <div class="cut cut-short"></div>
          <label for="email" class="placeholder">Email</label>
        </div>
        <br />
        <input type="file" name="image" size="50" />
        <button class="submitInscription">submit</button>
      </form>
    </div>
  </div>
</body>
  <router-view></router-view>
       
  
</template>

<script>
export default {
  name: "formulaireInscription",
  props: [],
  data() {
    return {
      afficher: false,
      afficherErreur: false,
    };
  },
  mounted() {
    if (sessionStorage.getItem("Personne-connécté")) {
      this.afficherErreur = true;
      document.body.style.backgroundColor = "#676767";
    } else {
      this.afficher = true;
    }
  },
  methods: {
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
