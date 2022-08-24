const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true
})

module.exports = {
  publicPath: ' ',
  // devServer: {
  //   proxy: 'https://localhost:3000'
  // },
  css: {
    loaderOptions: {
      sass: {
        sassOptions: {
          data: `../../../essaie-Projet/fichier-css/global.scss";` 
          //Note: the "@" in vue-cli is an alias that points to /src
        }
      }
    }
  } 
}
