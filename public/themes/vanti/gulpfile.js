const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix

    .sass('./assets/sass/website.scss', './assets/build')

    .styles([
        'node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
        'node_modules/owl.carousel/dist/assets/owl.theme.default.min.css',
        'assets/build/website.css'
    ], 'assets/css/website.css', './')

    .scripts([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/owl.carousel/dist/owl.carousel.min.js'
    ], 'assets/js/plugins.js', './')

    .copy('node_modules/bootstrap-sass/assets/fonts', 'assets/fonts');
});
