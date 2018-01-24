let mix = require('laravel-mix');

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


var plugin =  'resources/assets/js/';

mix.js('resources/assets/js/app.js', 'public/js/app.js')
.sass('resources/assets/sass/style.scss', 'public/css')	
.combine([  
		plugin + 'jquery.min.js',
		plugin + 'jquery.bxslider.min.js',
		plugin + 'bootstrap.min.js',
		plugin + 'paccordion.js'  ,
		plugin + 'custom.js'  ,
		plugin + 'tether.min.js'  ,
		'public/js/app.js'
],'public/js/bundle.min.js') 
.browserSync();