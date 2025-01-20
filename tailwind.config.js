import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                raleway: ['Raleway', 'sans-serif'],
                ruda: ['Ruda', 'sans-serif'],
            },
            colors: {
                'fuse-green': {
                    '50': '#eefbf5',
                    '100': '#d5f6e6',
                    '200': '#afebd0',
                    '300': '#7bdab6',
                    '400': '#45c296',
                    '500': '#21a179',
                    '600': '#158665',
                    '700': '#106c54',
                    '800': '#105543',
                    '900': '#0e4638',
                    '950': '#072721',
                },
            },
        },
    },

    plugins: [forms, typography],
};
