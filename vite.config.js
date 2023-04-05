import { createHtmlPlugin } from "vite-plugin-html";
import { defineConfig, splitVendorChunkPlugin, loadEnv, Plugin } from "vite";
import eslint from "vite-plugin-eslint";
import { esbuildCommonjs } from "@originjs/vite-plugin-commonjs";
import laravel from "laravel-vite-plugin";
import legacy from "@vitejs/plugin-legacy";
import manifestSRI from "vite-plugin-manifest-sri";
import path from "path";
import StylelintPlugin from "vite-plugin-stylelint";
import { webUpdateNotice } from "@plugin-web-update-notification/vite";
import { viteCommonjs } from "@originjs/vite-plugin-commonjs";
import { ViteMinifyPlugin } from "vite-plugin-minify";
import { viteStaticCopy } from "vite-plugin-static-copy";
import viteImagemin from "vite-plugin-imagemin";
import vue from "@vitejs/plugin-vue";
import Pages from "vite-plugin-pages";
import generateSitemap from "vite-plugin-pages-sitemap";
import "jquery";
import $ from "jquery";
import jQuery from "jquery";

export default ({ mode }) => {
  process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };
  return defineConfig({
    optimizeDeps: {
      force: true,
      esbuildOptions: {
        plugins: [esbuildCommonjs()],
      },
      include: ["jquery"],
    },
    build: {
      ssr: false,
      minify: "esnext",
      reportCompressedSize: true,
      chunkSizeWarningLimit: 1600,
      manifest: true,
      sourcemap: process.env.VITE_APP_ENV == "local" ? true : false,
      rollupOptions: {
        external: ["Vue"],
        output: {
          manualChunks(id, { getModuleInfo }) {
            const match = /.*\.strings\.(\w+)\.js/.exec(id);
            if (match) {
              const language = match[1]; // e.g. "en"
              const dependentEntryPoints = [];
              // we use a Set here so we handle each module at most once. This
              // prevents infinite loops in case of circular dependencies
              const idsToHandle = new Set(getModuleInfo(id).dynamicImporters);
              for (const moduleId of idsToHandle) {
                const { isEntry, dynamicImporters, importers } =
                  getModuleInfo(moduleId);
                if (isEntry || dynamicImporters.length > 0)
                  dependentEntryPoints.push(moduleId);
                // The Set iterator is intelligent enough to iterate over elements that
                // are added during iteration
                for (const importerId of importers) idsToHandle.add(importerId);
              }
              // If there is a unique entry, we put it into a chunk based on the entry name
              if (dependentEntryPoints.length === 1) {
                return `${
                  dependentEntryPoints[0].split("/").slice(-1)[0].split(".")[0]
                }.strings.${language}`;
              }
              // For multiple entries, we put it into a "shared" chunk
              if (dependentEntryPoints.length > 1) {
                return `shared.strings.${language}`;
              }
            }
          },
          globals: {
            vue: "Vue",
          },
        },
      },
      modulePreload: {
        polyfill: true,
      },
      commonjsOptions: {
        include: [/node_modules/],
      },
    },
    plugins: [
      laravel({
        input: ["resources/assets/sass/app.scss", "resources/assets/js/app.js"],
        refresh: true,
      }),
      // StylelintPlugin({
      //   fix: true,
      //   quite: false,
      //   lintOnStart: false,
      // }),
      // eslint({
      //   cache: true,
      //   fix: true,
      //   lintOnStart: false,
      //   emitWarning: true,
      //   emitError: true,
      //   failOnWarning: false,
      //   failOnError: true,
      // }),
      vue({
        template: {
          transformAssetUrls: {
            base: null,
            includeAbsolute: false,
          },
        },
      }),
      ViteMinifyPlugin({
        minifyCSS: true,
        removeComments: true,
      }),
      createHtmlPlugin({
        minify: true,
        entry: "resources/assets/js/app.js",
      }),
      viteCommonjs(),
      manifestSRI(),
      webUpdateNotice({
        logVersion: true,
        logHash: true,
        checkInterval: 0.5 * 60 * 1000,
        notificationProps: {
          title: "system update",
          description: "System update, please refresh the page",
          buttonText: "refresh",
        },
      }),
      viteStaticCopy({
        targets: [
          {
            src: "node_modules/hideshowpassword/images/wink.svg",
            dest: "assets/",
          },
          {
            src: "node_modules/hideshowpassword/images/wink.png",
            dest: "assets/",
          },
          // {
          //   src: 'resources/img/favicon/favicon.ico',
          //   dest: '../',
          // },
          // {
          //   src: 'resources/img/favicon/favicon-32x32.png',
          //   dest: '../',
          // },
          // {
          //   src: 'resources/img/favicon/android-chrome-192x192.png',
          //   dest: '../',
          // },
          // {
          //   src: 'resources/img/favicon/android-chrome-512x512.png',
          //   dest: '../',
          // },
          // {
          //   src: 'resources/img/favicon/apple-touch-icon.png',
          //   dest: '../',
          // },
          // {
          //   src: 'resources/img/favicon/favicon-16x16.png',
          //   dest: '../',
          // },
          // {
          //   src: 'resources/img/favicon/favicon.ico',
          //   dest: '../',
          // },
          // {
          //   src: 'resources/img/favicon/favicon.ico',
          //   dest: '',
          // },
          // {
          //   src: 'resources/img/favicon/favicon-32x32.png',
          //   dest: '',
          // },
          // {
          //   src: 'resources/img/favicon/android-chrome-192x192.png',
          //   dest: '',
          // },
          // {
          //   src: 'resources/img/favicon/android-chrome-512x512.png',
          //   dest: '',
          // },
          // {
          //   src: 'resources/img/favicon/apple-touch-icon.png',
          //   dest: '',
          // },
          // {
          //   src: 'resources/img/favicon/favicon-16x16.png',
          //   dest: '',
          // },
          // {
          //   src: 'resources/img/favicon/favicon.ico',
          //   dest: '',
          // },
        ],
      }),
      viteImagemin({
        gifsicle: {
          optimizationLevel: 7,
          interlaced: false,
        },
        optipng: {
          optimizationLevel: 7,
        },
        mozjpeg: {
          quality: 20,
        },
        pngquant: {
          quality: [0.8, 0.9],
          speed: 4,
        },
        svgo: {
          plugins: [
            {
              name: "removeViewBox",
            },
            {
              name: "removeEmptyAttrs",
              active: false,
            },
          ],
        },
      }),
      legacy({
        targets: ["defaults", "not IE 11"],
        polyfills: true,
      }),
      Pages({
        onRoutesGenerated: async (routes) => {
          generateSitemap({
            hostname: process.env.VITE_APP_NAME,
            routes: [...routes],
            readable: true,
            allowRobots: false,
            filename: "sitemap.xml",
          });
        },
      }),
    ],
    sourcemap: true,
    resolve: {
      alias: {
        "~": path.resolve(__dirname, "node_modules"),
        "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
        "~font-awesome": path.resolve(__dirname, "node_modules/font-awesome"),
        "@js": path.resolve(__dirname, "resources/assets/js"),
        "@sass": path.resolve(__dirname, "resources/assets/sass"),
      },
    },
    server: {
      port: 8080,
      hot: true,
    },
  });
};
