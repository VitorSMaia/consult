import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    server: {
        hmr: {
            host: "localhost"
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/sass/app.scss'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/src',
        },
    },
})