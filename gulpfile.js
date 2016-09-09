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
        .sass('app.scss', 'public/assets/build')
        .sass('frontend.scss', 'public/assets/css')

        .styles([
            'node_modules/jqtree/jqtree.css',
            'node_modules/pickadate/lib/compressed/themes/default.css',
            'node_modules/pickadate/lib/compressed/themes/default.date.css',
            'node_modules/pickadate/lib/compressed/themes/default.time.css',
            'node_modules/magnific-popup/dist/magnific-popup.css',
            'node_modules/sweetalert/dist/sweetalert.css',
            'semantic/dist/semantic.css',
            'public/assets/build/app.css'
        ], 'public/assets/css/main.css', './')

        .webpack('app.js', 'public/assets/js')
        .webpack('admin.js', 'public/assets/js')

        .scripts([
            'node_modules/js-cookie/src/js.cookie.js',
            'node_modules/sortablejs/Sortable.min.js',
            'node_modules/pickadate/lib/compressed/picker.js',
            'node_modules/pickadate/lib/compressed/picker.date.js',
            'node_modules/pickadate/lib/compressed/picker.time.js',
            'public/packages/ckeditor/ckeditor.js',
            'public/packages/ckeditor/adapters/jquery.js',
            'semantic/dist/semantic.js',
        ], 'public/assets/js/vendor.js', './')

        .copy('resources/assets/img', 'public/assets/img')
        .copy('semantic/dist/themes', 'public/assets/css/themes');
});
