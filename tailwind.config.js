import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                shake: "shake 0.5s ease-in-out infinite",
                wiggle: "wiggle 1s ease-in-out infinite",
                "wiggle-fast":
                    "wiggle-fast 0.82s cubic-bezier(.36,.07,.19,.0) both infinite",
            },
            keyframes: {
                shake: {
                    "0%": { transform: "skewX(-15deg)" },
                    "5%": { transform: "skewX(15deg)" },
                    "10%": { transform: "skewX(-15deg)" },
                    "15%": { transform: "skewX(15deg)" },
                    "20%": { transform: "skewX(0deg)" },
                    "100%": { transform: "skewX(0deg)" },
                },
                wiggle: {
                    "0%, 100%": { transform: "rotate(-3deg)" },
                    "50%": { transform: "rotate(3deg)" },
                },
                "wiggle-fast": {
                    // "0%": { transform: "rotate(0deg)" },
                    // "46%": { transform: "rotate(20deg)" },
                    // "47%": { transform: "rotate(-20deg)" },
                    // "48%": { transform: "rotate(20deg)" },
                    // "49%": { transform: "rotate(-20deg)" },
                    // "50%": { transform: "rotate(20deg)" },
                    // "51%": { transform: "rotate(-20deg)" },
                    // "52%": { transform: "rotate(20deg)" },
                    // "53%": { transform: "rotate(-20deg)" },
                    // "54%": { transform: "rotate(20deg)" },
                    // "55%": { transform: "rotate(0deg)" },
                    // "100%": { transform: "rotate(0deg)" },
                    "10%, 90%": {
                        transform: "translate3d(-1px, 0, 0)",
                    },

                    "20%, 80%": {
                        transform: "translate3d(2px, 0, 0)",
                    },

                    "30%, 50%, 70%": {
                        transform: "translate3d(-3px, 0, 0)",
                    },

                    "40%, 60%": {
                        transform: "translate3d(2px, 0, 0)",
                    },
                },
            },
        },
    },

    plugins: [forms],
};
