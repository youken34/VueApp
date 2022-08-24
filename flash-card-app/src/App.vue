
<template>

   <router-view></router-view>  <!-- Cette balise affiche la vue retourner par les router-link-->
  <!-- <button @click="showProduct(nom)"></button> -->
</template>


<script>

export default {
  name: 'App',
  data() {
    return {
      nom: "Rollers",
    }
  },
  
  components: {

 
  },
  methods: {
    showProduct: function(name) {
      this.$router.push({name: 'Product', params: {name: name}})
    },
    test() {
            for (let index = 0; index < 10; index++) {
                this.$refs.listeSelect.insertAdjacentHTML("afterbegin", "<option>" + index + "</option>");
                
            }
            
        }
    
  },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
