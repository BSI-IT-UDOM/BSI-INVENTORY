import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
            ],
            refresh: true,
        }),
        react(),
    ],
    resolve: {
        alias: {
            // If Bootstrap is installed via npm or yarn
            'bootstrap': 'bootstrap/dist/js/bootstrap.bundle.js'
        },
    },
});
