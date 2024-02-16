const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss','public/css')
    .copy('resources/sass/font','public/fonts')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
