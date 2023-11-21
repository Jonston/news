import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { copy } from 'vite-plugin-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        copy({
            targets: [
                { src: 'resources/images/**', dest: 'public/images' },
            ],
            hook: 'writeBundle',
        }),
    ],
});
