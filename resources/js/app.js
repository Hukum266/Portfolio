import './bootstrap';

/* ------------------------------------------------------------------ */
/*  Theme — anti-flash IIFE (runs before paint)                        */
/* ------------------------------------------------------------------ */
(function () {
    const saved      = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (saved === 'dark' || (!saved && prefersDark)) {
        document.documentElement.classList.add('dark');
    }
})();

/* ------------------------------------------------------------------ */
/*  DOM ready                                                           */
/* ------------------------------------------------------------------ */
document.addEventListener('DOMContentLoaded', function () {

    /* ── Theme icon sync ─────────────────────────────────────────── */
    const isDark = document.documentElement.classList.contains('dark');
    document.querySelectorAll('.theme-icon').forEach(icon => {
        icon.className = 'theme-icon fas ' + (isDark ? 'fa-sun' : 'fa-moon') + ' text-sm';
    });

    /* ── Mobile sidebar ──────────────────────────────────────────── */
    const menuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function openSidebar() {
        sidebar?.classList.remove('-translate-x-full');
        overlay?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    function closeSidebar() {
        sidebar?.classList.add('-translate-x-full');
        overlay?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    menuBtn?.addEventListener('click', openSidebar);
    overlay?.addEventListener('click', closeSidebar);

    /* ── Portfolio category filter ───────────────────────────────── */
    const filterBtns   = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const cat = this.dataset.filter;
            projectCards.forEach(card => {
                card.style.display = (cat === 'all' || card.dataset.category === cat) ? '' : 'none';
            });
        });
    });

    /* ── Skill bars (animate on scroll into view) ────────────────── */
    const skillBars = document.querySelectorAll('.skill-bar-fill');
    if (skillBars.length) {
        const barObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.style.width = e.target.dataset.width || '0%';
                    barObs.unobserve(e.target);
                }
            });
        }, { threshold: 0.3 });

        skillBars.forEach(bar => {
            bar.dataset.width = bar.style.width;
            bar.style.width   = '0%';
            barObs.observe(bar);
        });
    }

    /* ── Counter animation ───────────────────────────────────────── */
    const counters = document.querySelectorAll('.counter');
    if (counters.length) {
        const cntObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const el     = e.target;
                    const target = parseInt(el.dataset.target, 10);
                    const suffix = el.dataset.suffix || '';
                    let count    = 0;
                    const step   = Math.ceil(target / 60);
                    const timer  = setInterval(() => {
                        count += step;
                        if (count >= target) { count = target; clearInterval(timer); }
                        el.textContent = count + suffix;
                    }, 30);
                    cntObs.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(el => cntObs.observe(el));
    }

    /* ── Contact form AJAX ───────────────────────────────────────── */
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const btn    = contactForm.querySelector('button[type="submit"]');
            const status = document.getElementById('form-status');
            const orig   = btn.innerHTML;
            btn.disabled  = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending…';

            try {
                const res  = await fetch(contactForm.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: new FormData(contactForm),
                });
                const data = await res.json();
                if (res.ok) {
                    status.textContent = data.message || 'Message sent successfully!';
                    status.className   = 'mt-4 text-sm font-medium text-green-600';
                    contactForm.reset();
                } else {
                    const errors = Object.values(data.errors || {}).flat().join(' ');
                    status.textContent = errors || 'Something went wrong.';
                    status.className   = 'mt-4 text-sm font-medium text-red-500';
                }
            } catch {
                status.textContent = 'Network error. Please try again.';
                status.className   = 'mt-4 text-sm font-medium text-red-500';
            } finally {
                btn.disabled  = false;
                btn.innerHTML = orig;
            }
        });
    }
});
