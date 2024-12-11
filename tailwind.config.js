import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php",
    ],
    safelist: [
        {
            pattern:
                /bg-(blue|indigo|teal)-(50|100|200|300|400|500|600|700|800|900|950)/,
        },
        {
            pattern:
                /text-(blue|indigo|teal)-(50|100|200|300|400|500|600|700|800|900|950)/,
        },
    ],
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                "hero-bg": "url('/public/images/bg.png')",
            },
        },
    },

    plugins: [forms, typography],
};
