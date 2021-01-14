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

mix
    .webpackConfig({
        devtool: "inline-source-map"
    })
    .sourceMaps()
    .copyDirectory('node_modules/stisla/assets/img/avatar/', 'public/img/')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles(
        [
            "node_modules/stisla/assets/css/style.css",
            "node_modules/stisla/assets/css/components.css",
            "resources/css/custom.css",
            "node_modules/select2/dist/css/select2.css",
            "node_modules/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css"
        ],
        "public/css/template.css"
    )
    .scripts(
        [
            "node_modules/stisla/assets/js/stisla.js",
            "node_modules/stisla/assets/js/scripts.js",
            "node_modules/stisla/assets/js/custom.js",
            "node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js",
            "node_modules/select2/dist/js/select2.js",
            "node_modules/validatorjs/dist/validator.js",
        ],
        "public/js/template.js"
    )
    .version();
