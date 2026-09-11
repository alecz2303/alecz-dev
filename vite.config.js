import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/projects.css',
                'resources/css/services.css',
                'resources/css/chatbot.css',
                'resources/css/case-media.css',
                'resources/css/localization.css',
                'resources/css/command-dock.css',
                'resources/js/app.js',
                'resources/js/services.js',
                'resources/js/command-dock.js',
                'resources/js/contact-handoff.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
