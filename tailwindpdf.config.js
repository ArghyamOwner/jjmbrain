const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

module.exports = {
    mode: 'jit',
  
    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Inter', "HKGrotesk", ...defaultTheme.fontFamily.sans],
                serif: ['Plus Jakarta Sans', 'Inter', ...defaultTheme.fontFamily.serif]
            },
            screens: {
                'print': { 'raw': 'print'}
            }
        },

    },

    variants: {
        extend: {
            opacity: ['disabled']
        },
    },

    plugins: [
    ],
};
