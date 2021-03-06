const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/heatmap.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        ...(mix.inProduction() ? [require('postcss-purgecss-laravel')({})] : []),
        require('autoprefixer'),
    ])
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: "ts-loader",
                    exclude: /node_modules/
                }
            ]
        },
        resolve: {
            fallback: {"path": require.resolve("path-browserify")},
            extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"]
        }
    })
    .js('resources/js/uxsad-library.ts', 'public/js');
