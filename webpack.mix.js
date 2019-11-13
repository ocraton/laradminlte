const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
mix.styles([
      'public/css/admin-lte/dist/css/adminlte.min.css',
      'public/asset/fontawesome-free/css/fontawesome.min.css',
      'public/asset/fontawesome-free/css/solid.min.css',
      'public/asset/fontawesome-free/css/brands.min.css',            
  ], 'public/css/all.css');