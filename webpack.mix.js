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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();

mix.copy('resources/images/sources', 'public/images/sources');
mix.copy('resources/images/svg', 'public/images/svg');
mix.copy('resources/sources/admin/app-assets', 'public/sources/admin');
// mix.copy('resources/js', 'public/js');
mix.sass('resources/sources/admin/style.scss', 'public/sources/admin')
    .sass('resources/sources/main/style.scss', 'public/sources/main')
    .version();
