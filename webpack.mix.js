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

mix.disableSuccessNotifications();

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/front.css', 'public/css', [
        require('postcss-import'),
        require('autoprefixer'),
        require('cssnano'),
        require('tailwindcss')({
            content: [
                './resources/front-views/pages/*.blade.php',
                './resources/front-views/admin/*.blade.php',
                './resources/front-views/admin/**/*.blade.php',
                './resources/front-views/tenants/*.blade.php',
                './resources/front-views/tenants/**/*.blade.php',
                './resources/views/livewire/front/*.blade.php',
                './resources/views/livewire/front/**/*.blade.php',
                './resources/views/components/*.blade.php',
                './resources/views/components/**/*.blade.php',
                './resources/views/errors/*.blade.php',
                './resources/views/layouts/front.blade.php',
                './resources/views/partials/*.blade.php',
                './resources/views/partials/**/*.blade.php',
                './resources/views/vendor/livewire/tailwind.blade.php',
                './resources/views/tenants/*.blade.php',
                './resources/views/tenants/**/.blade.php',
            ],
            plugins: [
                require('@tailwindcss/forms'),
                require('@tailwindcss/typography'),
                require('@tailwindcss/line-clamp'),
            ],
            ...require('./tailwind.front.config.js'),
        }),
    ])
    .postCss('resources/css/auth.css', 'public/css', [
        require('postcss-import'),
        require('autoprefixer'),
        require('cssnano'),
        require('tailwindcss')({
            content: [
                './resources/front-views/pages/*.blade.php',
                './resources/views/auth/*.blade.php',
                './resources/views/errors/*.blade.php',
                './resources/views/components/*.blade.php',
                './resources/views/components/**/*.blade.php',
                './resources/views/layouts/guest.blade.php',
                './resources/views/schemes/*.blade.php',
                './resources/views/**/*.blade.php'
            ],
            ...require('./tailwind.config.js'),
        }),
    ])
    .postCss('resources/css/litholog.css', 'public/css', [
        require('postcss-import'),
        require('autoprefixer'),
        require('cssnano'),
        require('tailwindcss')({
            content: [
                './resources/views/litholog-pdf.blade.php'
            ],
            ...require('./tailwindpdf.config.js'),
        }),
    ])
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('autoprefixer'),
        require('cssnano'),
        require('tailwindcss')({
            content: [
                './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
                './storage/framework/views/*.php',
                './resources/views/**/*.blade.php'
            ],
            plugins: [
                require('@tailwindcss/forms'),
                require('@tailwindcss/typography'),
                require('@tailwindcss/line-clamp'),
            ],
            ...require('./tailwind.config.js'),
        }),
    ]);

