<template>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="center">
    <section ref="alert" class="message error">
        <header></header>
  <i></i>
  <h2>
    <span>Hello!</span> 
    This is the default look
  </h2>
    </section>
    </div>
    <div id="container" ref="div2" v-show="afficher == true">
    <div id="1">
        <select id="liste1" v-html="html">
        </select>
    </div> <br>
    <div id="liste" name="liste" ref="reference">
        <select id="liste2" ref="listeSelect" >
  
        </select>
    </div>
    <br>
    <input type="text" v-model="notes">
    <br>
</div> <br>
<button  @click="alerter()">Ajouter notes </button>
</body>
</html>

</template>


<script>
// eslint-disable-next-line no-unused-vars
import { ref } from "vue";



export default{
    data() {
        return {
            div: this.$refs.listeSelect,
            html: null,
            chiffer: 1000.000001,
            notes: null,
            afficher: true
            
        }
    },
    methods: {
        alerter(){
                    let alerte = this.$refs.alert
                    if (alerte.style.display == 'flex') {
                        alerte.style.display = 'none';
                        
                    }
                    else {
                        alerte.style.display = 'flex'
                    }
                    this.afficher = !this.afficher
                },
        menu() {
            for (let index = 0; index < 10; index++) {
                this.$refs.listeSelect.insertAdjacentHTML("afterbegin", "<option>" + index + "</option>");
                
            }
            
        },
                // eslint-disable-next-line vue/no-dupe-keys
        not(value) {
            
                localStorage.setItem(1, value)

               }
    },
    computed: {

    },
    watch : {
               
            },
    mounted() {
        
            localStorage.removeItem(1)
            
            // Création de la nouvelle div
            let nouvelleBaliseP = document.createElement('div')

            // Première méthode pour ajouter du texte
            nouvelleBaliseP.textContent = "Nouveau paragraphe crée";

            // Deuxième méthode pour ajouter du texte
            var newContent = document.createTextNode('Hi there and greetings!');
            nouvelleBaliseP.appendChild(newContent);

            let divActuelle = this.$refs.reference 
            // eslint-disable-next-line no-unused-vars
            let div2 = this.$refs.div2

            // Insertion de la balise
            div2.insertBefore(nouvelleBaliseP, divActuelle);
            
            // Génération du menu déroulant
            for (let index = 0; index < 10; index++) {
                this.html += "<option>" + index + "</option>";
                
            }
        },
}
</script>


<style lang="scss" scoped>
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

*,
*:after,
*:before {
  box-sizing: border-box;
}


.message{
  background:$light;
  box-shadow: 4px 4px 8px 0px rgba(0,0,0,0.31);
  border-radius:1em;
  overflow:hidden;
  display:none;
  flex-wrap:wrap;
  max-width:40em;
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

.center{
    display: flex;
    justify-content: center;
}
</style>