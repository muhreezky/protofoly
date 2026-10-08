// Protofoly Frontend Interactions
document.addEventListener('DOMContentLoaded', () => {
    // Theme Toggle Handler
    const themeToggleBtn = document.getElementById('theme-toggle-btn');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    }

    // Mobile Navigation Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOpenIcon = document.getElementById('mobile-menu-open-icon');
    const mobileMenuCloseIcon = document.getElementById('mobile-menu-close-icon');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', 'true');
                if (mobileMenuOpenIcon) mobileMenuOpenIcon.classList.add('hidden');
                if (mobileMenuCloseIcon) mobileMenuCloseIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
                if (mobileMenuOpenIcon) mobileMenuOpenIcon.classList.remove('hidden');
                if (mobileMenuCloseIcon) mobileMenuCloseIcon.classList.add('hidden');
            }
        });

        // Close mobile menu when clicking internal navigation links
        mobileMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
                if (mobileMenuOpenIcon) mobileMenuOpenIcon.classList.remove('hidden');
                if (mobileMenuCloseIcon) mobileMenuCloseIcon.classList.add('hidden');
            });
        });
    }

    // Projects Grid Filter Tabs
    const filterButtons = document.querySelectorAll('.work-filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const filterValue = button.getAttribute('data-filter');

            // Reset active style on all buttons
            filterButtons.forEach((btn) => {
                btn.classList.remove('bg-white', 'dark:bg-zinc-800', 'text-zinc-900', 'dark:text-white', 'shadow-sm', 'font-semibold');
                btn.classList.add('text-zinc-600', 'dark:text-zinc-400', 'font-medium');
            });

            // Set active style on clicked button
            button.classList.add('bg-white', 'dark:bg-zinc-800', 'text-zinc-900', 'dark:text-white', 'shadow-sm', 'font-semibold');
            button.classList.remove('text-zinc-600', 'dark:text-zinc-400', 'font-medium');

            // Filter cards
            projectCards.forEach((card) => {
                const category = card.getAttribute('data-category');
                if (filterValue === 'all' || category === filterValue) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    });

    // Floating Back to Top Button
    const backToTopBtn = document.getElementById('back-to-top-btn');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                backToTopBtn.classList.remove('hidden');
                backToTopBtn.classList.add('flex');
            } else {
                backToTopBtn.classList.add('hidden');
                backToTopBtn.classList.remove('flex');
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        });
    }
});
