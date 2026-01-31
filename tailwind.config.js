const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './node_modules/flowbite/**/*.js',
    './resources/**/*.js',
  ],

  theme: {
    extend: {
      fontSize: {
        xxs: '0.512rem', // ~8.2px
        xs: '0.64rem', // ~10.2px
        sm: '0.8rem', // ~12.8px
        base: '1rem', // 16px
        lg: '1.25rem', // 20px
        xl: '1.563rem', // 25px
        '2xl': '1.953rem', // 31.25px
        '3xl': '2.441rem', // ~39.06px
        '4xl': '3.052rem', // ~48.83px
        '5xl': '3.815rem', // ~61.04px
      },
      fontFamily: {
        poppins: ['Poppins', 'sans-serif'],
      },
      backgroundImage: {
        'hero-pattern': "url('images/landingSalad.png')",
      },

      colors: {
        'yellow-rgba-84': 'rgba(255, 222, 108, 0.84)',
        primary: '#FFCE01',
        primarySecondary: '#FFDE6C',
        secondary: '#FFFCF0',
        accent: '#A07C00',
        accentSecondary: '#EDB01C',
        dark: '#282222',
        light: '#fffcf0',
        lightSecondary: '#FFFDF6',
      },
    },
  },

  daisyui: {
    themes: [
      {
        mytheme: {
          primary: '#FF7B54',

          secondary: '#FFB26B',

          accent: '#FFD56B',

          neutral: '#3D4451',

          'base-100': '#FFFFFF',

          info: '#3ABFF8',

          success: '#36D399',

          warning: '#FBBD23',

          error: '#F87272',
        },
      },
    ],
  },
  plugins: [require('@tailwindcss/forms', 'daisyui', 'flowbite')],
  darkMode: 'calss',
};
