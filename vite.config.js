import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: true,
        port: 5173,
        hmr: { host: '0.0.0.0'},
        watch: {
            usePolling: true,
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/404.css',

                'resources/js/app.js',
                'resources/js/editImages.js',
                'resources/js/home.js',
                'resources/js/swiperJs.js',
                'resources/js/deleteConfirmation.js',
            ],
            refresh: true,
        }),
    ],
});
