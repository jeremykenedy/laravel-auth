import { defineConfig, splitVendorChunkPlugin, loadEnv, Plugin } from "vite";
import laravel from "laravel-vite-plugin";
import { esbuildCommonjs } from "@originjs/vite-plugin-commonjs";
import path from "path";
import { ViteMinifyPlugin } from "vite-plugin-minify";

export default ({ mode }) => {
  return defineConfig({
    optimizeDeps: {
      force: true,
      esbuildOptions: {
        plugins: [esbuildCommonjs()],
      },
    },
    plugins: [
      laravel({
        input: ["resources/assets/sass/app.scss", "resources/assets/js/app.js"],
        refresh: true,
      }),
      ViteMinifyPlugin({
        minifyCSS: true,
        removeComments: true,
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
  });
};

// export default defineConfig({
//   plugins: [
//     laravel({
//       input: [
//         'resources/assets/sass/app.scss',
//         'resources/assets/js/app.js',
//       ],
//       refresh: true,
//     }),
//   ],
// });
