import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/frontend.scss",
                "resources/sass/app.scss",
                "resources/js/frontend.js",
                "resources/js/jquery.js",
                "resources/js/jqueryui.js",
                "resources/js/app.js"],
            refresh: true,
        })
    ],
});
