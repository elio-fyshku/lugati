// const path = require('path');
const mix = require('laravel-mix');
require('laravel-mix-purgecss');
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

const host = process.env.APP_HOST || '192.168.10.10'
const proxy = process.env.APP_PROXY || 'taxsolutions-theme.test'

mix.js('resources/js/app.js', 'build/scripts')
    .sass('resources/sass/app.scss', 'build/styles')
    .setPublicPath('build')
    // HACK to fix problems with url in css files
    .setResourceRoot('../../build/')
    .disableNotifications()
    // .purgeCss({
    //     enabled: mix.inProduction(),
    //     folders: ['resources', 'app', 'woocommerce'],
    //     globs: [
    //         path.join(__dirname, 'header.php'),
    //         path.join(__dirname, 'footer.php'),
    //         path.join(__dirname, 'index.php'),
    //         path.join(__dirname, 'page.php'),
    //         path.join(__dirname, 'single.php'),
    //     ],
    //     whitelistPatterns: [/flickity/, /mfp-/],
    //     whitelistPatternsChildren: [/woocommerce/, /widget/, /select2/],
    //     extensions: ['html', 'js', 'php', 'vue'],
    // })
    // .browserSync({
    //     host: host,
    //     proxy: proxy,
    //     open: false,
    //     files: [
    //         'app/**/*.php',
    //         'resources/**/*.php',
    //         'resources/**/*.js',
    //         'resources/**/*.scss',
    //         'resources/**/*.sass',
    //     ],
    //     watchOptions: {
    //         usePolling: true,
    //         interval: 500,
    //     }
    // });

if (mix.inProduction()) {
    mix.version();
}