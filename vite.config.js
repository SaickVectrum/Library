import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
	//Está parte se suele usar para docker
	server: {
		host: '0.0.0.0',
		port: 5173,
		hmr: {
			host: '127.0.0.1'
		}
	},
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
		}),
		//Acá se le indica que va a trabajar con vue
        vue(),
	],
	//Esto muestra advertencias cuando un chunk sobrepase los 1600 KB
	build: { chunkSizeWarningLimit: 1600},
    resolve: {
        alias: {
			vue: 'vue/dist/vue.esm-bundler.js',
			'@': path.resolve(__dirname, 'resources/js'),
			'~': path.resolve(__dirname, 'node_modules')
        },
    },
});
