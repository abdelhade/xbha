import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Primary palette
                'teal':        '#2e8a99',
                'teal-light':  '#3aa0b0',
                'teal-dark':   '#1f6370',
                'cream':       '#f0e8cc',
                'cream-dim':   '#e8ddb8',
                'coral':       '#f47c51',
                'coral-dark':  '#c95f3a',
                // Semantic aliases
                'primary':     '#2e8a99',
                'primary-light':'#3aa0b0',
                'secondary':   '#f47c51',
                'secondary-dark':'#c95f3a',
                'surface':     '#1a2e35',
                'surface-deep':'#0f1e23',
            },
            fontFamily: {
                sans: ['Cairo', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
