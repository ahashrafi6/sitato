const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/site/js/site.js', 'public/assets/site/js')
    .js('resources/assets/site/js/alpine.js', 'public/assets/site/js')
    .js('resources/assets/site/js/uppy.js', 'public/assets/site/js')
    .js('resources/assets/site/js/vue.js', 'public/assets/site/js')

    .sass('resources/assets/dashboard/sass/vue.scss' , 'public/assets/dashboard/scss')
    .sass('resources/assets/site/scss/site.scss' , 'public/assets/site/scss')
    .sass('resources/assets/site/scss/uppy.scss' , 'public/assets/site/scss')
    .postCss('resources/assets/site/css/site.css', 'public/assets/site/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.js('resources/assets/dashboard/js/vue.js', 'public/assets/dashboard/js').vue()
