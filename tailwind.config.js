const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '0.5rem',
              },
        },
        extend: {
            fontFamily: {
                'lato-sans': ['Lato', 'sans-serif'],
            },
            colors: {
                azure: {
                    DEFAULT: '#0099CC',
                    darker: '#0080B3',
                },
                space: {
                    DEFAULT: '#006699',
                    darker: '#004D80',
                },
                lime: {
                    DEFAULT: '#00CC00',
                    darker: '#00B300',
                },
                pumpkin: {
                    DEFAULT: '#FF6600',
                    darker: '#E64D00',
                },
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            cursor: ['hover'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
