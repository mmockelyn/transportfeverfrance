const mix = require('laravel-mix');
let LiveReloadPlugin = require('webpack-livereload-plugin');

mix.disableNotifications();

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

mix.sass('resources/sass/front/app.scss', 'public/front/css')
    .js('resources/js/back/app.js', 'public/back/js/app.js')
    .js('resources/js/account/app.js', 'public/account/js/app.js');


mix.webpackConfig({
    resolve: {
        alias: {
            'morris.js': 'morris.js/morris.js',
            'jquery-ui': 'jquery-ui',
        },
    },
    plugins: [
        new LiveReloadPlugin()
    ]
});
