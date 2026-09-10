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

const normalize = (value) => value
    .toLowerCase()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .replace(/[^a-z0-9\s+#.]/g, ' ')
    .replace(/\s+/g, ' ')
    .trim();

const chat = document.querySelector('[data-chat]');

if (chat) {
    const toggle = chat.querySelector('[data-chat-toggle]');
    const panel = chat.querySelector('[data-chat-panel]');
    const close = chat.querySelector('[data-chat-close]');
    const messages = chat.querySelector('[data-chat-messages]');
    const topicButtons = chat.querySelectorAll('[data-chat-topic]');
    const externalOpeners = document.querySelectorAll('[data-chat-open]');
    const form = chat.querySelector('[data-chat-form]');
    const input = chat.querySelector('[data-chat-input]');
    const knowledgeNode = document.querySelector('[data-chat-knowledge]');
    const whatsapp = chat.dataset.whatsapp || '';
    const email = chat.dataset.email || '';
    const projects = knowledgeNode ? JSON.parse(knowledgeNode.textContent || '[]') : [];

    const intentKeywords = {
        mobile: ['app', 'apps', 'movil', 'android', 'flutter', 'celular', 'baseball', 'beisbol'],
        biometrics: ['biometria', 'biometrico', 'huella', 'identidad', 'asistencia', 'lector', 'digital persona'],
        clinical: ['clinica', 'clinico', 'terapia', 'terapeuta', 'paciente', 'cita', 'citas', 'agenda'],
        academic: ['academia', 'academico', 'escuela', 'alumno', 'alumnos', 'mensualidad', 'mensualidades', 'chamilo', 'lms'],
        payments: ['pago', 'pagos', 'cobro', 'cobros', 'mensualidad', 'recibo', 'suscripcion'],
        integrations: ['api', 'integracion', 'integraciones', 'whatsapp', 'google drive', 'drive', 'sincronizacion', 'hardware', 'lms'],
        saas: ['saas', 'sistema', 'plataforma', 'web', 'laravel', 'multi tenant', 'multitenant'],
        automation: ['automatizar', 'automatizacion', 'notificacion', 'recordatorio', 'proceso', 'procesos'],
    };

    const projectHints = {
        mobile: ['citas-crit', 'baseball-app'],
        biometrics: ['digital-persona-schoolbio'],
        clinical: ['urpe-gestion-clinica', 'citas-crit'],
        academic: ['acadcontrol', 'digital-persona-schoolbio'],
        payments: ['acadcontrol', 'doctotal'],
        integrations: ['digital-persona-schoolbio', 'acadcontrol', 'baseball-app'],
        saas: ['doctotal', 'urpe-gestion-clinica', 'acadcontrol'],
        automation: ['acadcontrol', 'doctotal'],
    };

    const setOpen = (open) => {
        panel.setAttribute('aria-hidden', String(!open));
        toggle.setAttribute('aria-expanded', String(open));
        chat.classList.toggle('is-open', open);

        if (open) {
            input?.focus();
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

    const addProjectLinks = (matches) => {
        const links = document.createElement('div');
        links.className = 'chat-project-links';

        matches.slice(0, 3).forEach((project) => {
            const link = document.createElement('a');
            link.href = project.url;
            link.textContent = `${project.name} →`;
            links.appendChild(link);
        });

        if (links.childElementCount) {
            messages.appendChild(links);
            messages.scrollTop = messages.scrollHeight;
        }
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

        if (!actions.childElementCount) {
            addMessage('Los canales directos todavía no están publicados. Mientras tanto puedo ayudarte a identificar qué experiencia de Alecz se parece más a lo que necesitas.');
            return;
        }

        messages.appendChild(actions);
        messages.scrollTop = messages.scrollHeight;
    };

    const scoreProjects = (query) => {
        const normalizedQuery = normalize(query);
        const words = normalizedQuery.split(' ').filter((word) => word.length > 2);
        const boostedSlugs = new Set();

        Object.entries(intentKeywords).forEach(([intent, keywords]) => {
            if (keywords.some((keyword) => normalizedQuery.includes(normalize(keyword)))) {
                (projectHints[intent] || []).forEach((slug) => boostedSlugs.add(slug));
            }
        });

        return projects
            .map((project) => {
                const haystack = normalize([
                    project.name,
                    project.type,
                    project.summary,
                    project.signal,
                    ...(project.stack || []),
                    ...(project.capabilities || []),
                ].join(' '));
                let score = boostedSlugs.has(project.slug) ? 4 : 0;
                words.forEach((word) => {
                    if (haystack.includes(word)) score += 1;
                });
                if (normalizedQuery.includes(normalize(project.name))) score += 8;
                return { ...project, score };
            })
            .filter((project) => project.score > 0)
            .sort((a, b) => b.score - a.score);
    };

    const answerFreeText = (query) => {
        const normalizedQuery = normalize(query);

        if (!normalizedQuery) return;

        if (['contacto', 'contactar', 'whatsapp', 'correo', 'email', 'cotizar', 'cotizacion'].some((word) => normalizedQuery.includes(word))) {
            addMessage('Sí. Si Alecz tiene canales directos habilitados en este momento, te los muestro aquí.');
            addContactActions();
            return;
        }

        if (['que haces', 'que puede', 'servicio', 'servicios', 'desarrollas', 'construyes', 'puedes hacer'].some((phrase) => normalizedQuery.includes(normalize(phrase)))) {
            addMessage('Alecz construye productos web y móviles, sistemas de gestión, automatizaciones e integraciones entre APIs, servicios externos, datos y hardware. Si me cuentas el problema, puedo relacionarlo con experiencia real del portafolio.');
            return;
        }

        const matches = scoreProjects(query);

        if (matches.length) {
            const names = matches.slice(0, 3).map((project) => project.name).join(', ');
            addMessage(`Por lo que describes, revisaría ${names}. Son proyectos reales que cubren partes parecidas del problema. Abre los case studies para ver contexto, solución y arquitectura sin exponer código fuente.`);
            addProjectLinks(matches);
            return;
        }

        addMessage('No encontré una coincidencia clara todavía. Cuéntame qué proceso quieres mejorar, quién lo usaría y si imaginas una app, plataforma web, integración o automatización. Con eso puedo orientarte mejor.');
    };

    const replies = {
        projects: 'Alecz ha construido productos móviles, SaaS, software clínico, plataformas académicas y soluciones biométricas. Puedes abrir cada case study y ver problema, solución, capacidades y arquitectura.',
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
                addProjectLinks(projects);
            }

            if (topic === 'contact') {
                addContactActions();
            }
        });
    });

    form?.addEventListener('submit', (event) => {
        event.preventDefault();
        const query = input.value.trim();
        if (!query) return;
        addMessage(query, 'user');
        input.value = '';
        answerFreeText(query);
        input.focus();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && chat.classList.contains('is-open')) {
            setOpen(false);
        }
    });
}
