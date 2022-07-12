import { defineConfig } from 'vite'
import reactRefresh from '@vitejs/plugin-react-refresh'
import laravel from "vite-plugin-laravel";
import dynamicImportVars from '@rollup/plugin-dynamic-import-vars'


export default defineConfig({
    server: {
        host: '0.0.0.0'
    },
    build: {
        manifest: true,
        outDir: 'public/build',
        sourcemap: true,
        rollupOptions: {
            plugins: [dynamicImportVars()],
        },
    },
    plugins: [
        reactRefresh(),
        laravel(),
    ],
    optimizeDeps: {
        include: [
            'react',
            'react-dom',
            '@inertiajs/inertia',
            '@inertiajs/inertia-react',
            '@inertiajs/progress',
            '@mui/material',
            '@mui/icons-material'
        ],
    },
})
