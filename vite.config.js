import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '192.168.50.44', // Force it to listen on your IP
        cors: true,            // Enable CORS
        hmr: {
            host: '192.168.50.44',
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
