var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss', './public/css/app.css')
       .sass('backend/app.scss', './public/css/backend/app.css');

    mix.copy('resources/bower_components/material-design-lite/material.min.js', 'public/js/material.min.js');

    mix.copy('node_modules/vue/dist/vue.min.js', 'public/js/vue.min.js');
    mix.copy('node_modules/vue/dist/vue.common.js', 'public/js/vue.common.js');

});
