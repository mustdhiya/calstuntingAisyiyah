/**
 * public-index.js
 * Script untuk interaksi landing page (index) publik.
 */

document.addEventListener("DOMContentLoaded", function () {
    // ── Hamburger menu ──
    const hamburgerBtn  = document.getElementById('hamburger-btn');
    const mobileMenu    = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    
    if (hamburgerBtn && mobileMenu && hamburgerIcon) {
        hamburgerBtn.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            hamburgerIcon.textContent = isOpen ? 'close' : 'menu';
            hamburgerBtn.setAttribute('aria-expanded', isOpen);
        });
    }

    // ── Navbar scroll shadow ──
    const header = document.querySelector('header');
    if (header) {
        window.addEventListener('scroll', () => {
            header.style.boxShadow = window.scrollY > 10
                ? '0 4px 20px rgba(0,0,0,0.08)'
                : 'none';
        }, { passive: true });
    }
});

// ── FAQ accordion ──
function toggleFaq(btn) {
    const content = btn.nextElementSibling;
    const icon    = btn.querySelector('.faq-icon');
    const isOpen  = content.classList.contains('open');
    
    // Close all
    document.querySelectorAll('.faq-content').forEach(c => c.classList.remove('open'));
    document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate'));
    document.querySelectorAll('.faq-btn').forEach(b => b.setAttribute('aria-expanded', 'false'));
    
    // Toggle clicked
    if (!isOpen && content && icon) {
        content.classList.add('open');
        icon.classList.add('rotate');
        btn.setAttribute('aria-expanded', 'true');
    }
}
