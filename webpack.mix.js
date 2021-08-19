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

mix.styles([
    'resources/plantilla/css/adminlte.min.css',
    'resources/plantilla/css/daterangepicker.css',
    'resources/plantilla/css/icheck-bootstrap.min.css',
    'resources/plantilla/css/jqvmap.min.css',
    'resources/plantilla/css/OverlayScrollbars.min.css',
    'resources/plantilla/css/summernote-bs4.min.css',
    'resources/plantilla/css/tempusdominus-bootstrap-4.min.css'
], 'public/css/plantilla.css')
.scripts([
    'resources/plantilla/js/adminlte.js',
    'resources/plantilla/js/Chart.min.js',
    'resources/plantilla/js/dashboard.js',
    'resources/plantilla/js/daterangepicker.js',
    'resources/plantilla/js/jquery-ui.min.js',
    'resources/plantilla/js/jquery.knob.min.js',
    'resources/plantilla/js/jquery.overlayScrollbars.min.js',
    'resources/plantilla/js/jquery.vmap.min.js',
    'resources/plantilla/js/jquery.vmap.usa.js',
    'resources/plantilla/js/moment.min.js',
    'resources/plantilla/js/sparkline.js',
    'resources/plantilla/js/summernote-bs4.min.js',
    'resources/plantilla/js/tempusdominus-bootstrap-4.min.js',
    'resources/plantilla/js/demo.js'
], 'public/js/plantilla.js')
.js(['resources/js/app.js'],'public/js/app.js')
.vue();