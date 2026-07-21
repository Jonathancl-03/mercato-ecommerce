import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Fraunces', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                stone: {
                    50: '#F7F5F1',
                    100: '#E2DED5',
                },
                forest: {
                    600: '#2D4A3E',
                    700: '#233A30',
                },
                mustard: {
                    500: '#C9A227',
                },
                ink: {
                    900: '#1C1F26',
                },
            },
        },
    },

    plugins: [forms],
};