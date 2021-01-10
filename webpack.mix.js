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
    .js('resources/js/app.js', 'public/js')
    .styles(
        [
            "node_modules/bootstrap/dist/css/bootstrap.css",
            "node_modules/stisla/assets/css/style.css",
            "node_modules/stisla/assets/css/components.css",
            "node_modules/stisla/assets/css/custom.css",
        ],
        "public/css/app.css"
    )
    .scripts(
        [
            "node_modules/stisla/assets/js/stisla.js",
            "node_modules/stisla/assets/js/scripts.js",
            "node_modules/stisla/assets/js/custom.js",
        ],
        "public/js/template.js"
    )
    .version();
