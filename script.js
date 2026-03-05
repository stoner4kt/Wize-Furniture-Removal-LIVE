document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('js-enabled');

    const menuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (menuBtn && navLinks) {
        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('open');
        });
    }

    const animatedElements = document.querySelectorAll('[data-animate]');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, { threshold: 0.1 });

        animatedElements.forEach((el) => observer.observe(el));
    } else {
        animatedElements.forEach((el) => el.classList.add('animate-in'));
    }

    document.querySelectorAll('.accordion-header').forEach((header) => {
        header.addEventListener('click', () => {
            header.parentElement.classList.toggle('active');
        });
    });

    if (!document.querySelector('.whatsapp-float')) {
        const whatsappLink = document.createElement('a');
        whatsappLink.href = 'https://wa.me/27663128522';
        whatsappLink.className = 'whatsapp-float';
        whatsappLink.target = '_blank';
        whatsappLink.rel = 'noopener noreferrer';
        whatsappLink.setAttribute('aria-label', 'Chat on WhatsApp');
        whatsappLink.innerHTML = '<i class="fab fa-whatsapp"></i>';
        document.body.appendChild(whatsappLink);
    }
});
