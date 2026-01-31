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
        'x-small': ['var(--text-xs)', { lineHeight: 'var(--body-line-height)' }],
        small: ['var(--text-small)', { lineHeight: 'var(--body-line-height)' }],
        base: ['var(--text-base)', { lineHeight: 'var(--body-line-height)', fontWeight: '500' }],
        h6: [
          'var(--text-h6)',
          {
            lineHeight: 'var(--heading-line-height)',
            letterSpacing: 'var(--heading-letter-spacing)',
            fontWeight: '700',
          },
        ],
        h5: [
          'var(--text-h5)',
          {
            lineHeight: 'var(--heading-line-height)',
            letterSpacing: 'var(--heading-letter-spacing)',
            fontWeight: '700',
          },
        ],
        h4: [
          'var(--text-h4)',
          {
            lineHeight: 'var(--heading-line-height)',
            letterSpacing: 'var(--heading-letter-spacing)',
            fontWeight: '700',
          },
        ],
        h3: [
          'var(--text-h3)',
          {
            lineHeight: 'var(--heading-line-height)',
            letterSpacing: 'var(--heading-letter-spacing)',
            fontWeight: '700',
          },
        ],
        h2: [
          'var(--text-h2)',
          {
            lineHeight: 'var(--heading-line-height)',
            letterSpacing: 'var(--heading-letter-spacing)',
            fontWeight: '700',
          },
        ],
        h1: [
          'var(--text-h1)',
          {
            lineHeight: 'var(--heading-line-height)',
            letterSpacing: 'var(--heading-letter-spacing)',
            fontWeight: '700',
          },
        ],
        display: [
          'var(--text-display)',
          {
            lineHeight: 'var(--heading-line-height)',
            letterSpacing: 'var(--heading-letter-spacing)',
            fontWeight: '700',
          },
        ],
      },
      fontFamily: {
        poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
        inter: ['Inter', ...defaultTheme.fontFamily.sans],
        sans: ['Inter', 'Poppins', ...defaultTheme.fontFamily.sans],
      },
      backgroundImage: {
        'hero-pattern': "url('images/landingSalad.png')",
      },

      colors: {
        border: 'hsl(var(--border))',
        input: 'hsl(var(--input))',
        ring: 'hsl(var(--ring))',
        background: 'hsl(var(--background))',
        foreground: 'hsl(var(--foreground))',
        primary: {
          DEFAULT: 'hsl(var(--primary))',
          foreground: 'hsl(var(--primary-foreground))',
        },
        secondary: {
          DEFAULT: 'hsl(var(--secondary))',
          foreground: 'hsl(var(--secondary-foreground))',
        },
        destructive: {
          DEFAULT: 'hsl(var(--destructive))',
          foreground: 'hsl(var(--destructive-foreground))',
        },
        muted: {
          DEFAULT: 'hsl(var(--muted))',
          foreground: 'hsl(var(--muted-foreground))',
        },
        accent: {
          DEFAULT: 'hsl(var(--accent))',
          foreground: 'hsl(var(--accent-foreground))',
        },
        popover: {
          DEFAULT: 'hsl(var(--popover))',
          foreground: 'hsl(var(--popover-foreground))',
        },
        card: {
          DEFAULT: 'hsl(var(--card))',
          foreground: 'hsl(var(--card-foreground))',
        },
        'yellow-rgba-84': 'rgba(255, 222, 108, 0.84)',
        primarySecondary: '#FFDE6C',
        // secondary: '#FFFCF0', // Overridden by hsl var above
        accentSecondary: '#EDB01C',
        dark: '#282222',
        light: '#fffcf0',
        lightSecondary: '#FFFDF6',
      },
      borderRadius: {
        lg: `var(--radius)`,
        md: `calc(var(--radius) - 2px)`,
        sm: `calc(var(--radius) - 4px)`,
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
  darkMode: 'class',
};
