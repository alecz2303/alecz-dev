import './bootstrap';

const navToggle = document.querySelector('[data-nav-toggle]');
const nav = document.querySelector('[data-nav]');

if (navToggle && nav) {
    navToggle.addEventListener('click', () => {
        const isOpen = nav.classList.toggle('is-open');
        navToggle.setAttribute('aria-expanded', String(isOpen));
    });

    nav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            nav.classList.remove('is-open');
            navToggle.setAttribute('aria-expanded', 'false');
        });
    });
}

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const revealElements = document.querySelectorAll('[data-reveal]');

if (reduceMotion) {
    revealElements.forEach((element) => element.classList.add('is-visible'));
} else {
    requestAnimationFrame(() => {
        revealElements.forEach((element) => element.classList.add('is-visible'));
    });
}

const chat = document.querySelector('[data-chat]');

if (chat) {
    const toggle = chat.querySelector('[data-chat-toggle]');
    const panel = chat.querySelector('[data-chat-panel]');
    const close = chat.querySelector('[data-chat-close]');
    const messages = chat.querySelector('[data-chat-messages]');
    const topicButtons = chat.querySelectorAll('[data-chat-topic]');
    const externalOpeners = document.querySelectorAll('[data-chat-open]');
    const whatsapp = chat.dataset.whatsapp || '';
    const email = chat.dataset.email || '';

    const setOpen = (open) => {
        panel.setAttribute('aria-hidden', String(!open));
        toggle.setAttribute('aria-expanded', String(open));
        chat.classList.toggle('is-open', open);

        if (open) {
            close.focus();
        } else {
            toggle.focus();
        }
    };

    const addMessage = (text, type = 'bot') => {
        const message = document.createElement('div');
        message.className = `chat-message is-${type}`;
        message.textContent = text;
        messages.appendChild(message);
        messages.scrollTop = messages.scrollHeight;
    };

    const addContactActions = () => {
        const actions = document.createElement('div');
        actions.className = 'chat-contact-actions';

        if (whatsapp) {
            const link = document.createElement('a');
            link.href = `https://wa.me/${whatsapp}`;
            link.target = '_blank';
            link.rel = 'noopener noreferrer';
            link.textContent = 'Abrir WhatsApp ↗';
            actions.appendChild(link);
        }

        if (email) {
            const link = document.createElement('a');
            link.href = `mailto:${email}`;
            link.textContent = 'Enviar correo';
            actions.appendChild(link);
        }

        if (!whatsapp && !email) {
            addMessage('Los canales directos todavía no están publicados. Puedes revisar los proyectos y volver cuando Alecz habilite WhatsApp o correo.');
            return;
        }

        messages.appendChild(actions);
        messages.scrollTop = messages.scrollHeight;
    };

    const replies = {
        projects: 'Alecz ha construido productos móviles, SaaS, software clínico, plataformas académicas y soluciones biométricas. En ~/projects puedes abrir cada case study y ver problema, solución, capacidades y arquitectura.',
        services: 'Puede construir productos web con Laravel, apps móviles con Flutter, integraciones con APIs y servicios externos, sistemas de gestión y soluciones que conectan software con hardware o procesos reales.',
        contact: 'Perfecto. Te muestro los canales directos que Alecz haya decidido publicar para este portafolio.',
    };

    toggle.addEventListener('click', () => setOpen(!chat.classList.contains('is-open')));
    close.addEventListener('click', () => setOpen(false));
    externalOpeners.forEach((button) => button.addEventListener('click', () => setOpen(true)));

    topicButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const topic = button.dataset.chatTopic;
            addMessage(button.textContent.trim(), 'user');
            addMessage(replies[topic] || 'Puedo ayudarte a explorar el portafolio.');

            if (topic === 'projects') {
                const link = document.createElement('a');
                link.className = 'chat-inline-link';
                link.href = `${window.location.origin}/#proyectos`;
                link.textContent = 'Ir a ~/projects →';
                messages.appendChild(link);
            }

            if (topic === 'contact') {
                addContactActions();
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && chat.classList.contains('is-open')) {
            setOpen(false);
        }
    });
}
