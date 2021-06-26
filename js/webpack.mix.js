const mix = require('laravel-mix');

mix.webpackConfig({
    output: {
        library: 'laravelRecharts',
        libraryTarget: 'umd',
        umdNamedDefine: true,
    },
});

mix.autoload({
    'react': ['window.React'],
});

mix.js('src/app.js', 'dist')
   .react()
   .setPublicPath('dist');
