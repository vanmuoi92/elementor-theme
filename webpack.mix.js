let mix = require("laravel-mix");
// const path = require("path");
// const glob = require("glob");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.sass("assets/scss/app.scss", "assets/css/").sourceMaps(true, "source-map");
mix.js("assets/js/main.js", "assets/scripts/main.js");
mix
	// .scripts(['../../plugins/qode-plugins/qode-theme/scripts/default.js'], '../../plugins/qode-plugins/qode-theme/js/default.min.js')
	// .scripts(['../../plugins/qode-plugins/qode-theme/scripts/main.js'], '../../plugins/qode-plugins/js/main.js')

	.options({
		processCssUrls: false,
	});

// glob.sync("assets/scss/components/*.scss").forEach((file) => {
// 	const { name } = path.parse(file);
// 	mix.sourceMaps(true, "source-map")
// 		.sass(file, `assets/css/components/${name}.css`)
// 		.options({
// 			processCssUrls: false,
// 		});
// });

// glob.sync("assets/scss/pages/*.scss").forEach((file) => {
// 	const { name } = path.parse(file);
// 	mix.sourceMaps(true, "source-map")
// 		.sass(file, `assets/css/pages/${name}.css`)
// 		.options({
// 			processCssUrls: false,
// 		});
// });

// glob.sync("assets/js/components/*.js").forEach((file) => {
// 	const { name } = path.parse(file);
// 	mix.js(file, `assets/scripts/components/${name}.js`);
// });

// glob.sync("assets/js/pages/*.js").forEach((file) => {
// 	const { name } = path.parse(file);
// 	mix.js(file, `assets/scripts/pages/${name}.js`);
// });
