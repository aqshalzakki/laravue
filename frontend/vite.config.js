import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import Pages from 'vite-plugin-pages'
import Layouts from 'vite-plugin-vue-layouts';
const path = require('path')

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue(), Pages({
    dirs: 'src/views',
  }), Layouts()],
  resolve: {
    alias: {
      // '@': fileURLToPath(new URL('./src', import.meta.url)),
      '@' : path.resolve(__dirname, './src')
    }
  }
})
