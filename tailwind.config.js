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
            },
        },
       /* colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: '#000',
            white: '#fff',
            gray: {
                50: '#f9fafb',
                100: '#f4f5f7',
                200: '#e5e7eb',
                300: '#d2d6dc',
                400: '#9fa6b2',
                500: '#6b7280',
                600: '#4b5563',
                700: '#374151',
                800: '#252f3f',
                900: '#161e2e',
            },
            red: {
                50: '#fdf2f2',
                100: '#fde8e8',
                200: '#fbd5d5',
                300: '#f8b4b4',
                400: '#f98080',
                500: '#f05252',
                600: '#e02424',
                700: '#c81e1e',
                800: '#9b1c1c',
                900: '#771d1d',
            },
            yellow: {
                50: '#fdfdea',
                100: '#fdf6b2',
                200: '#fce96a',
                300: '#faca15',
                400: '#e3a008',
                500: '#c27803',
                600: '#9f580a',
                700: '#8e4b10',
                800: '#723b13',
                900: '#633112',
            },
            green: {
                50: '#f3faf7',
                100: '#def7ec',
                200: '#bcf0da',
                300: '#84e1bc',
                400: '#31c48d',
                500: '#0e9f6e',
                600: '#057a55',
                700: '#046c4e',
                800: '#03543f',
                900: '#014737',
            },
            emerald: {
                50: '#ecfdf5',
                100: '#d1fae5',
                200: '#a7f3d0',
                300: '#6ee7b7',
                400: '#34d399',
                500: '#10b981',
                600: '#059669',
                700: '#047857',
                800: '#065f46',
                900: '#064e3b',
            },
            blue: {
                50: '#ebf5ff',
                100: '#e1effe',
                200: '#c3ddfd',
                300: '#a4cafe',
                400: '#76a9fa',
                500: '#3f83f8',
                600: '#1c64f2',
                700: '#1a56db',
                800: '#1e429f',
                900: '#233876',
            },
        },*/
    },
    darkMode: 'class',

    plugins: [forms, typography],
};
