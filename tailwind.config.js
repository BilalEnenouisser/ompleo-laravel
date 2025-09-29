/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        mono: ['monospace'],
        display: ['Space Grotesk', 'sans-serif']
      },
      colors: {
        primary: {
          50: '#eef7ff',
          100: '#d9edff',
          200: '#bce0ff',
          300: '#8aceff',
          400: '#50b2ff',
          500: '#00b6b4',
          600: '#009e9c',
          700: '#008684',
          800: '#006e6c',
          900: '#005654',
        },
        secondary: {
          50: '#f8fafc',
          100: '#f1f5f9',
          200: '#e2e8f0',
          300: '#cbd5e1',
          400: '#94a3b8',
          500: '#64748b',
          600: '#475569',
          700: '#334155',
          800: '#1e293b',
          900: '#0f172a',
        },
        accent: {
          50: '#eefff9',
          100: '#d5fff0',
          200: '#aeffdf',
          300: '#70ffca',
          400: '#2bffa8',
          500: '#00b6b4',
          600: '#009e9c',
          700: '#008684',
          800: '#006e6c',
          900: '#005654',
        },
        dark: {
          50: '#f8fafc',
          100: '#f1f5f9',
          200: '#e2e8f0',
          300: '#cbd5e1',
          400: '#94a3b8',
          500: '#64748b',
          600: '#475569',
          700: '#333333',
          800: '#2b2b2b',
          900: '#1f1f1f',
          950: '#111111',
        }
      },
      animation: {
        'fade-in': 'fadeIn 0.6s ease-out forwards',
        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
        'fade-in-down': 'fadeInDown 0.8s ease-out forwards',
        'fade-in-left': 'fadeInLeft 0.8s ease-out forwards',
        'fade-in-right': 'fadeInRight 0.8s ease-out forwards',
        'scale-in': 'scaleIn 0.6s ease-out forwards',
        'bounce-gentle': 'bounceGentle 3s ease-in-out infinite',
        'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
        'float': 'float 3s ease-in-out infinite',
        'counter': 'counter 2s ease-out',
        'gradient-shift': 'gradientShift 3s ease-in-out infinite',
        'liquid': 'liquid 8s ease-in-out infinite',
        'liquid-shift': 'liquidShift 10s ease-in-out infinite',
        'shimmer': 'shimmer 3s infinite',
        'glow-pulse': 'glowPulse 2s infinite',
        'rotate-slow': 'rotate 10s linear infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        fadeInUp: {
          '0%': { opacity: '0', transform: 'translateY(20px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        fadeInDown: {
          '0%': { opacity: '0', transform: 'translateY(-20px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        fadeInLeft: {
          '0%': { opacity: '0', transform: 'translateX(-20px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        fadeInRight: {
          '0%': { opacity: '0', transform: 'translateX(20px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        scaleIn: {
          '0%': { opacity: '0', transform: 'scale(0.95)' },
          '100%': { opacity: '1', transform: 'scale(1)' },
        },
        bounceGentle: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-10px)' },
        },
        pulseGlow: {
          '0%, 100%': { 
            boxShadow: '0 0 10px rgba(0, 182, 180, 0.3), 0 0 20px rgba(0, 182, 180, 0.1)',
            transform: 'scale(1)'
          },
          '50%': { 
            boxShadow: '0 0 20px rgba(0, 182, 180, 0.6), 0 0 40px rgba(0, 182, 180, 0.3)',
            transform: 'scale(1.05)'
          },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-10px)' },
        },
        counter: {
          '0%': { transform: 'scale(0.8)', opacity: '0' },
          '100%': { transform: 'scale(1)', opacity: '1' },
        },
        gradientShift: {
          '0%, 100%': { backgroundPosition: '0% 50%' },
          '50%': { backgroundPosition: '100% 50%' },
        },
        liquid: {
          '0%, 100%': { borderRadius: '60% 40% 30% 70% / 60% 30% 70% 40%' },
          '50%': { borderRadius: '30% 60% 70% 40% / 50% 60% 30% 60%' },
        },
        liquidShift: {
          '0%': { transform: 'translateX(0) translateY(0)' },
          '25%': { transform: 'translateX(5px) translateY(-5px)' },
          '50%': { transform: 'translateX(0) translateY(0)' },
          '75%': { transform: 'translateX(-5px) translateY(5px)' },
          '100%': { transform: 'translateX(0) translateY(0)' },
        },
        shimmer: {
          '0%': { backgroundPosition: '-200% 0' },
          '100%': { backgroundPosition: '200% 0' },
        },
        glowPulse: {
          '0%, 100%': { opacity: 0.6 },
          '50%': { opacity: 1 },
        },
        rotate: {
          '0%': { transform: 'rotate(0deg)' },
          '100%': { transform: 'rotate(360deg)' },
        },
      },
      boxShadow: {
        'glass': '0 8px 32px rgba(0, 0, 0, 0.1)',
        'glass-dark': '0 8px 32px rgba(0, 0, 0, 0.2)',
        'glass-highlight': '0 8px 32px rgba(0, 182, 180, 0.1)',
        'glass-glow': '0 0 15px rgba(0, 182, 180, 0.3)',
        'glass-glow-hover': '0 0 20px rgba(0, 182, 180, 0.5)',
      },
      backdropBlur: {
        'xs': '2px',
      },
    },
  },
  plugins: [],
}

