const Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .enableTypeScriptLoader()

  .addEntry('js/app', './assets/js/app.ts') // your js entry file
  .addStyleEntry('css/app', './assets/css/app.css') // your less/scss entry file

  .enablePostCssLoader()
  .enableSingleRuntimeChunk()
  ;

module.exports = Encore.getWebpackConfig();
