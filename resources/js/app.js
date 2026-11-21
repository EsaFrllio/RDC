import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';

window.Alpine = Alpine;

// Initialize Alpine
Alpine.start();

// ─── AOS Scroll Reveal — with prefers-reduced-motion guard ───────────────────
document.addEventListener('DOMContentLoaded', () => {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    AOS.init({
        duration: prefersReduced ? 0 : 700,
        once: true,
        easing: 'ease-out-cubic',
        offset: 60,
        disable: prefersReduced,
    });
});

// ─── Scroll listener: navbar shrink + scroll-to-top button ───────────────────
window.addEventListener('scroll', () => {
    // Navbar: shrink padding + add shadow after 20px
    const navbar = document.getElementById('navbar');
    if (navbar) {
        if (window.scrollY > 20) {
            navbar.classList.add('shadow-xl', 'py-2');
            navbar.classList.remove('py-3', 'sm:py-3.5');
        } else {
            navbar.classList.remove('shadow-xl', 'py-2');
            navbar.classList.add('py-3', 'sm:py-3.5');
        }
    }

    // Scroll-to-top: show after scrolling 400px
    const scrollBtn = document.getElementById('scroll-to-top');
    if (scrollBtn) {
        if (window.scrollY > 400) {
            scrollBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-3');
            scrollBtn.classList.add('opacity-100', 'translate-y-0');
        } else {
            scrollBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-3');
            scrollBtn.classList.remove('opacity-100', 'translate-y-0');
        }
    }
}, { passive: true });
