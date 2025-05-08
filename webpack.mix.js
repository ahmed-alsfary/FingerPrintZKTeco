const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .version()
    .sourceMaps()
    .browserSync({
        proxy: 'localhost:8000',
        open: false
    })
    .options({
        processCssUrls: false,
        postCss: [
            require('postcss-import'),
            require('tailwindcss'),
            require('autoprefixer'),
        ],
    })
    .webpackConfig({
        cache: true,
        optimization: {
            splitChunks: {
                chunks: 'all',
                cacheGroups: {
                    vendor: {
                        test: /[\\/]node_modules[\\/]/,
                        name: 'vendor',
                        chunks: 'all',
                    },
                },
            },
        },
    }); 