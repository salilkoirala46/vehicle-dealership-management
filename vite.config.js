import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');

    const vitePort = parseInt(env.VITE_PORT || process.env.VITE_PORT || '5173');
    const devServerUrl = env.VITE_DEV_SERVER_URL || `http://localhost:${vitePort}`;

    // Extract HMR host from the dev server URL (strip protocol)
    const hmrHost = devServerUrl.replace(/^https?:\/\//, '');
    const isHttps = devServerUrl.startsWith('https');

    return {
        plugins: [
            laravel({
                input: ["resources/css/app.css", "resources/js/app.js"],
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        resolve: {
            alias: {
                vue: "vue/dist/vue.esm-bundler.js",
            },
        },
        server: {
            host: '0.0.0.0',
            port: vitePort,
            strictPort: true,
            origin: devServerUrl,
            cors: true,
            headers: {
                'Access-Control-Allow-Origin': '*',
            },
            hmr: {
                host: hmrHost,
                clientPort: isHttps ? 443 : vitePort,
            },
        },
    };
});
