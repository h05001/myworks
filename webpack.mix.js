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
    .js('resources/js/test.js', 'public/js')
    //.copy('node_modules/chart.js/dist/chart.js', 'public/chart.js/chart.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/front.scss', 'public/css'); //
