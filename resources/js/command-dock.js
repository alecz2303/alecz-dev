const dock = document.querySelector('[data-command-dock]');

if (dock) {
    const root = dock.querySelector('[data-dock-root]');
    const links = [...dock.querySelectorAll('[data-dock-section]')];
    const hero = document.querySelector('.hero');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const sections = links.map((link) => document.getElementById(link.dataset.dockSection)).filter(Boolean);

    const setVisible = () => {
        const threshold = hero ? Math.max(hero.offsetTop + Math.min(hero.offsetHeight * .55, 520), 180) : 180;
        const visible = window.scrollY > threshold;
        dock.classList.toggle('is-visible', visible);
        dock.setAttribute('aria-hidden', String(!visible));
    };

    const setActive = () => {
        if (!sections.length) return;
        const marker = window.scrollY + Math.min(window.innerHeight * .36, 300);
        let active = sections[0];
        sections.forEach((section) => { if (section.offsetTop <= marker) active = section; });
        links.forEach((link) => {
            if (link.dataset.dockSection === active.id) link.setAttribute('aria-current', 'location');
            else link.removeAttribute('aria-current');
        });
    };

    let scheduled = false;
    const sync = () => {
        if (scheduled) return;
        scheduled = true;
        requestAnimationFrame(() => { setVisible(); setActive(); scheduled = false; });
    };

    window.addEventListener('scroll', sync, { passive: true });
    window.addEventListener('resize', sync, { passive: true });
    links.forEach((link) => link.addEventListener('click', () => link.setAttribute('aria-current', 'location')));
    root?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' }));
    setVisible(); setActive();
}
