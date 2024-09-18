/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        bsicolor: {
          DEFAULT: '#FF6608',
        },
        primary: {
          DEFAULT: '#0066CB', // Default primary color
          foreground: '#ffffff', // Foreground color for primary
          // Add more shades if needed
          100: '#ebf8ff',
          200: '#bee3f8',
          300: '#90cdf4',
          400: '#63b3ed',
          500: '#4299e1',
          600: '#3182ce',
          700: '#2b6cb0',
          800: '#2c5282',
          900: '#2a4365',
        },
        secondary: {
          DEFAULT: '#6B7280', // Default secondary color
          foreground: '#F9FAFB', // Foreground color for secondary
          100: '#E5E7EB',
          200: '#D1D5DB',
          300: '#9CA3AF',
          400: '#6B7280',
          500: '#4B5563',
          600: '#374151',
          700: '#1F2937',
          800: '#111827',
          900: '#000000',
        },
      },
      fontFamily: {
        'times': ['"Times New Roman"', 'serif'],
      },
      spacing: {
        '22': '90px',
        '24': '100px',
      },
    },
  },
  plugins: [],
}

