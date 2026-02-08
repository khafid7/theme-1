import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/css/rustic.css', 
                'resources/css/floral-pastel.css',
                'resources/css/watercolor.css',
                'resources/css/ocean.css',
                'resources/css/boho.css',
                'resources/css/emerald.css',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '127.0.0.1', // Memaksa menggunakan IPv4
    },
});