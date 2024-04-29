require('dotenv').config(); 
const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/bootstrap.js", "public/js")
    .js("resources/js/cart.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        //
    ]).scripts([
        'node_modules/laravel-echo/dist/echo.js', // Adjust the path as per your project structure
        // other scripts
    ], 'public/js/all.js');
