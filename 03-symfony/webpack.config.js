var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  .addEntry('js/app', './assets/js/app.js') // your js entry file
  .addStyleEntry('css/app', './assets/css/app.css') // your less/scss entry file

  .enablePostCssLoader()
  .enableSingleRuntimeChunk()
  ;

module.exports = Encore.getWebpackConfig();
