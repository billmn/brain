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
            // 'node_modules/magnific-popup/dist/jquery.magnific-popup.min.js',
            // 'node_modules/sweetalert/dist/sweetalert.min.js',
            'public/assets/vendor/ckeditor/ckeditor.js',
            'public/assets/vendor/ckeditor/adapters/jquery.js',
            'semantic/dist/semantic.js',
            'resources/assets/js/classes/_filemanager.js'
            // 'public/assets/build/app.js'
        ], 'public/assets/js/vendor.js', './')

        .copy('semantic/dist/themes', 'public/assets/css/themes');
});
