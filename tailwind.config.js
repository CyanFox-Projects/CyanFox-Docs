/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",

        './app/Livewire/**/*.php',

        './lang/**/*.php',
        './app/Support/**/*.php',

        "./pages/**/*.blade.php",
        "./pages/**/*.md",

        './vendor/robsontenorio/mary/src/View/Components/**/*.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("daisyui"),
        require('@tailwindcss/typography')
    ],
    daisyui: {
        themes: [
            "light",
            "dark",
        ],
    },
}
