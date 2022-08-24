<template>

<div class="form" v-show="afficher == true">
  <router-link to="/">Connexion</router-link>
  <br>
 
  <form enctype="multipart/form-data" action="http://localhost:3000/essaie-projet/Fichier-php/inscription.php" method="POST">
    <div class="title">Welcome</div>
    <div class="input-container ic1">
      <input id="firstname" class="input" type="text" placeholder=" " name="prenom" />
      <div class="cut"></div>
      <label for="firstname" class="placeholder">First name</label>
    </div>
    <div class="input-container ic2">
      <input id="lastname" class="input" type="text" placeholder=" " name="nom" />
      <div class="cut"></div>
      <label for="lastname" class="placeholder">Last name</label>
    </div>
    <div class="input-container ic2">
      <input id="email" class="input" type="text" placeholder=" " name="mail" />
      <div class="cut cut-short"></div>
      <label for="email" class="placeholder">Email</label>
    </div>
    <br>
    <input type="file" name="image" size="50"/>
    <button  class="submitInscription">submit</button>
  </form>
</div>
   <router-view></router-view> 

</template>

<script>
    export default {
        name: "formulaireInscription",
        props: [],
        data() {
              return {
              afficher: false,

              }
            },
            mounted() {
            if (sessionStorage.getItem("Personne-connécté")) {
            
            alert("Vous êtes déja connectez")
            this.$router.push({name: 'Accueil'})
          }
          else {
            this.afficher = true
          }
            }
            }
            
    

</script>

<style  lang="scss" scoped>
@import '@../../../essaie-projet/fichier-css/global.scss';


</style>
