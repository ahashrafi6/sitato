const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        borderRadius: {
            'none': '0',
            'sm': '0.125rem',
            DEFAULT: '0.25rem',
            DEFAULT: '4px',
            'md': '0.375rem',
            'lg': '0.5rem',
            'xl': '0.75rem',
            '2xl': '1rem',
            '3xl': '1.5rem',
            'full': '9999px',
            'large': '12px',
            '100': '100px'
          },
        colors:{
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            red: colors.red,
            yellow: colors.amber,
            blue: colors.blue,
            green: colors.teal,
            orange: colors.orange,
            primary: colors.emerald,
            purple: colors.purple,
            pink: colors.pink,
        },
        extend: {
            fontFamily: {
                'yekan': ['Yekan-Regular', 'Tahoma', 'Arial', 'sans-serif'],
                'yekan-black': ['Yekan-Black', 'Tahoma', 'Arial', 'sans-serif'],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled' , 'dark'],
            display: ['dark'],
            boxShadow: ['dark'],
            backgroundImage: ['hover']
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
