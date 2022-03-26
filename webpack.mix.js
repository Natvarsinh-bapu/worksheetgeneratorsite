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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.sass('resources/sass/worksheet.scss', 'public/css');

mix.js('resources/js/superadmin.js', 'public/js').version();
mix.js('resources/js/admin.js', 'public/js').version();
mix.js('resources/js/institute.js', 'public/js').version();
mix.js('resources/js/pdf.js', 'public/js').version();
mix.js('resources/js/teacher.js', 'public/js').version();
mix.js('resources/js/student.js', 'public/js').version();