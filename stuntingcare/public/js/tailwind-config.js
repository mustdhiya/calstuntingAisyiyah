/**
 * tailwind-config.js
 * Konfigurasi kustom untuk Tailwind Play CDN & DaisyUI.
 */

tailwind.config = {
  theme: {
    extend: {
      fontFamily: { sans: ['Inter', 'sans-serif'] },
      colors: {
        brand: {
          primary: '#059669',
          secondary: '#0891B2',
          accent: '#F59E0B',
          dark: '#064E3B',
          soft: '#ECFDF5'
        }
      }
    }
  },
  daisyui: {
    themes: [{
      sicegah: {
        primary: '#059669',
        secondary: '#0891B2',
        accent: '#F59E0B',
        neutral: '#1F2937',
        'base-100': '#FFFFFF',
        'base-200': '#F8FAFC',
        'base-300': '#E5E7EB',
        info: '#0EA5E9',
        success: '#10B981',
        warning: '#F59E0B',
        error: '#EF4444'
      }
    }]
  }
}
