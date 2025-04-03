const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

const num = [1, 2, 3, 4, 5, 6, 8, 10, 12]
const safelist = ['grid']
num.map((x) => {
  safelist.push('grid-cols-' + x)
  safelist.push('sm:grid-cols-' + x)
  safelist.push('md:grid-cols-' + x)
  safelist.push('lg:grid-cols-' + x)
  safelist.push('xl:grid-cols-' + x)

  safelist.push('gap-' + x)
  safelist.push('sm:gap-' + x)
  safelist.push('md:gap-' + x)
  safelist.push('lg:gap-' + x)
  safelist.push('xl:gap-' + x)
});

module.exports = {
    mode: 'jit',
    
    safelist: safelist,
   
    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Inter', "HKGrotesk", ...defaultTheme.fontFamily.sans],
                serif: ['Plus Jakarta Sans', 'Inter', ...defaultTheme.fontFamily.serif]
            },
            screens: {
                'print': { 'raw': 'print'}
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))'
            },
            width: {
                'square-diagonal': (Math.sqrt(2) * 100).toFixed(2) + '%'
            },
            colors: {
                'great-blue': {
                    DEFAULT: '#2A669F',
                    50: '#E4F7F8',
                    100: '#CCEEF2',
                    200: '#9CD7E5',
                    300: '#6CB9D8',
                    400: '#3B94CB',
                    500: '#2A669F',
                    600: '#234B83',
                    700: '#1B3366',
                    800: '#14204A',
                    900: '#0C102E'
                },
            }
        },

    },

    variants: {
        extend: {
            opacity: ['disabled']
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp'),
       
        plugin(function({ matchUtilities, theme }) {
            matchUtilities(
                {
                    'bg-gradient': (angle) => ({
                        'background-image': `linear-gradient(${angle}, var(--tw-gradient-stops))`,
                    }),
                },
                {
                    values: Object.assign(
                        theme('bgGradientDeg', {}),
                        {
                            10: '10deg',
                            15: '15deg',
                            20: '20deg',
                            25: '25deg',
                            30: '30deg',
                            45: '45deg',
                            60: '60deg',
                            90: '90deg',
                            120: '120deg',
                            135: '135deg',
                        }
                    )
                }
            )
        })
    ],
};
