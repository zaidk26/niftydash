let mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix
  .webpackConfig({
    resolve: {
      alias: {
        '@': path.resolve('resources/sass')
      }
    }
  })

  .js('resources/js/app.js', 'public/js/app.js')  
  .sass('resources/sass/app.scss', 'public/css/app.css')

  .purgeCss() 

  .version()

  .browserSync({
    proxy: 'http://niftydash.oo',
    browser: 'chrome'
  });
