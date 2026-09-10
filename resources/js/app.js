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
    const submit = chat.querySelector('[data-chat-submit]');
    const knowledgeNode = document.querySelector('[data-chat-knowledge]');
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const endpoint = chat.dataset.chatEndpoint || '';
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

        if (open) input?.focus();
        else toggle.focus();
    };

    const addMessage = (text, type = 'bot') => {
        const message = document.createElement('div');
        message.className = `chat-message is-${type}`;
        message.textContent = text;
        messages.appendChild(message);
        messages.scrollTop = messages.scrollHeight;
        return message;
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

    const localFallback = (query) => {
        const normalizedQuery = normalize(query);

        if (['contacto', 'contactar', 'whatsapp', 'correo', 'email', 'cotizar', 'cotizacion'].some((word) => normalizedQuery.includes(word))) {
            return {
                message: 'Sí. Si Alecz tiene canales directos habilitados, te los muestro aquí.',
                projects: [],
                show_contact: true,
            };
        }

        const matches = scoreProjects(query).slice(0, 3);
        if (matches.length) {
            return {
                message: `Por lo que describes, revisaría ${matches.map((project) => project.name).join(', ')}. Son proyectos reales con problemas parecidos.`,
                projects: matches,
                show_contact: false,
            };
        }

        return {
            message: 'No pude consultar el asistente del servidor en este momento. Cuéntame qué proceso quieres mejorar, quién lo usaría y si imaginas una app, plataforma web, integración o automatización.',
            projects: [],
            show_contact: false,
        };
    };

    const renderReply = (reply) => {
        addMessage(reply.message || 'Puedo ayudarte a explorar el portafolio.');
        if (Array.isArray(reply.projects) && reply.projects.length) addProjectLinks(reply.projects);
        if (reply.show_contact) addContactActions();
    };

    const askServer = async (query) => {
        if (!endpoint) return localFallback(query);

        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({ message: query }),
        });

        if (!response.ok) {
            throw new Error(`Chat request failed with ${response.status}`);
        }

        return response.json();
    };

    const submitQuery = async (query) => {
        addMessage(query, 'user');
        input.value = '';
        input.disabled = true;
        submit.disabled = true;
        submit.textContent = '...';
        const pending = addMessage('Analizando tu necesidad…');

        try {
            const reply = await askServer(query);
            pending.remove();
            renderReply(reply);
        } catch {
            pending.remove();
            renderReply(localFallback(query));
        } finally {
            input.disabled = false;
            submit.disabled = false;
            submit.textContent = 'Enviar';
            input.focus();
        }
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
            if (topic === 'projects') addProjectLinks(projects);
            if (topic === 'contact') addContactActions();
        });
    });

    form?.addEventListener('submit', (event) => {
        event.preventDefault();
        const query = input.value.trim();
        if (!query || submit.disabled) return;
        submitQuery(query);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && chat.classList.contains('is-open')) setOpen(false);
    });
}
