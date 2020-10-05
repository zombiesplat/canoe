const mix = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources/js'
        }
    }
});

require('vuetifyjs-mix-extension');
mix.js('resources/js/app.js', 'public/js')
    .vuetify();
