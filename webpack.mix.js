let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
   devServer: {
      disableHostCheck: true,
      host: '0.0.0.0'
   }
});

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/hello_vuejs.js', 'public/js');
mix.js('resources/assets/js/hello_ajax.js', 'public/js');
mix.js('resources/assets/js/hello_gmap.js', 'public/js');

