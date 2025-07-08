import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/landingpage.css",
                "resources/css/consultation.css",
                "resources/css/components/navbar.css",
                "resources/css/articles.css",
                "resources/css/profile.css",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
