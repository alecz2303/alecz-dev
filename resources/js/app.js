import './bootstrap';

const navToggle = document.querySelector('[data-nav-toggle]');
const nav = document.querySelector('[data-nav]');

if (navToggle && nav) {
    navToggle.addEventListener('click', () => {
        const isOpen = nav.classList.toggle('is-open');
        navToggle.setAttribute('aria-expanded', String(isOpen));
    });
    nav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
        nav.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
    }));
}

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const revealElements = document.querySelectorAll('[data-reveal]');
if (reduceMotion) revealElements.forEach((element) => element.classList.add('is-visible'));
else requestAnimationFrame(() => revealElements.forEach((element) => element.classList.add('is-visible')));

const normalize = (value) => value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[^a-z0-9\s+#.]/g, ' ').replace(/\s+/g, ' ').trim();
const chat = document.querySelector('[data-chat]');

if (chat) {
    const toggle = chat.querySelector('[data-chat-toggle]');
    const panel = chat.querySelector('[data-chat-panel]');
    const close = chat.querySelector('[data-chat-close]');
    const messages = chat.querySelector('[data-chat-messages]');
    const options = chat.querySelector('[data-chat-options]');
    const optionsToggle = chat.querySelector('[data-chat-options-toggle]');
    const topicButtons = chat.querySelectorAll('[data-chat-topic]');
    const externalOpeners = document.querySelectorAll('[data-chat-open]');
    const form = chat.querySelector('[data-chat-form]');
    const input = chat.querySelector('[data-chat-input]');
    const submit = chat.querySelector('[data-chat-submit]');
    const knowledgeNode = document.querySelector('[data-chat-knowledge]');
    const copyNode = document.querySelector('[data-chat-copy]');
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const endpoint = chat.dataset.chatEndpoint || '';
    const whatsapp = chat.dataset.whatsapp || '';
    const email = chat.dataset.email || '';
    const projects = knowledgeNode ? JSON.parse(knowledgeNode.textContent || '[]') : [];
    const copy = copyNode ? JSON.parse(copyNode.textContent || '{}') : {};

    let qualification = null;
    let qualificationField = null;

    const intentKeywords = {
        mobile: ['app','apps','movil','mobile','android','flutter','celular','phone','baseball','beisbol'],
        biometrics: ['biometria','biometrico','biometrics','fingerprint','huella','identity','identidad','attendance','asistencia','reader','lector','digital persona'],
        clinical: ['clinica','clinical','therapy','terapia','therapist','terapeuta','patient','paciente','appointment','appointments','cita','citas','agenda','schedule'],
        academic: ['academia','academic','school','escuela','student','students','alumno','alumnos','tuition','mensualidad','chamilo','lms'],
        payments: ['pago','pagos','payment','payments','billing','cobro','mensualidad','receipt','recibo','subscription','suscripcion'],
        integrations: ['api','integracion','integration','integrations','whatsapp','google drive','drive','sync','sincronizacion','hardware','lms'],
        saas: ['saas','sistema','system','plataforma','platform','web','laravel','multi tenant','multitenant'],
        automation: ['automatizar','automatizacion','automation','automate','notification','notificacion','reminder','recordatorio','process','proceso'],
    };
    const projectHints = {
        mobile: ['citas-crit','baseball-app'], biometrics: ['digital-persona-schoolbio'], clinical: ['urpe-gestion-clinica','citas-crit'], academic: ['acadcontrol','digital-persona-schoolbio'], payments: ['acadcontrol','doctotal'], integrations: ['digital-persona-schoolbio','acadcontrol','baseball-app'], saas: ['doctotal','urpe-gestion-clinica','acadcontrol'], automation: ['acadcontrol','doctotal'],
    };

    const setOpen = (open) => {
        panel.setAttribute('aria-hidden', String(!open));
        toggle.setAttribute('aria-expanded', String(open));
        chat.classList.toggle('is-open', open);
        if (open) input?.focus(); else toggle.focus();
    };

    const setQuickOptions = (visible) => {
        if (!options || !optionsToggle) return;
        options.hidden = !visible;
        optionsToggle.hidden = false;
        optionsToggle.setAttribute('aria-expanded', String(visible));
        optionsToggle.textContent = visible ? copy.hide_options : copy.options;
        chat.classList.toggle('has-active-conversation', !visible);
        messages.scrollTop = messages.scrollHeight;
    };
    const collapseQuickOptions = () => setQuickOptions(false);

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

    const undefinedValue = () => copy.summary?.undefined || '—';
    const buildLeadSummary = () => {
        const lead = qualification || {};
        const normalizedBudget = normalize(lead.budget || '');
        const omittedBudget = ['no','prefiero no decir','sin presupuesto','no budget','prefer not to say'].includes(normalizedBudget);
        const budget = lead.budget && !omittedBudget ? lead.budget : undefinedValue();
        return [
            copy.summary.title, '',
            `${copy.summary.problem}: ${lead.problem || undefinedValue()}`,
            `${copy.summary.solution}: ${lead.solution || undefinedValue()}`,
            `${copy.summary.users}: ${lead.users || undefinedValue()}`,
            `${copy.summary.timeframe}: ${lead.timeframe || undefinedValue()}`,
            `${copy.summary.budget}: ${budget}`,
        ].join('\n');
    };

    const addContactActions = (summary = '') => {
        const actions = document.createElement('div');
        actions.className = 'chat-contact-actions';
        const encodedSummary = encodeURIComponent(summary);
        if (whatsapp) {
            const link = document.createElement('a');
            link.href = `https://wa.me/${whatsapp}${summary ? `?text=${encodedSummary}` : ''}`;
            link.target = '_blank'; link.rel = 'noopener noreferrer';
            link.textContent = summary ? copy.actions.wa_summary : copy.actions.wa;
            actions.appendChild(link);
        }
        if (email) {
            const link = document.createElement('a');
            const subject = encodeURIComponent(copy.actions.mail_subject);
            link.href = summary ? `mailto:${email}?subject=${subject}&body=${encodedSummary}` : `mailto:${email}`;
            link.textContent = summary ? copy.actions.mail_summary : copy.actions.mail;
            actions.appendChild(link);
        }
        if (!actions.childElementCount) {
            addMessage(copy.actions.no_channel);
            return;
        }
        messages.appendChild(actions);
        messages.scrollTop = messages.scrollHeight;
    };

    const renderLeadSummary = () => {
        const summary = buildLeadSummary();
        const card = document.createElement('div');
        card.className = 'chat-lead-summary';
        const title = document.createElement('strong');
        title.textContent = copy.summary.heading;
        card.appendChild(title);
        const pre = document.createElement('pre');
        pre.textContent = summary;
        card.appendChild(pre);
        messages.appendChild(card);
        messages.scrollTop = messages.scrollHeight;
        addMessage(copy.summary.ready);
        addContactActions(summary);
    };

    const askQualificationQuestion = (field) => {
        qualificationField = field;
        addMessage(copy.qualification[field]);
    };
    const startQualification = (initialProblem = '') => {
        collapseQuickOptions();
        qualification = { problem: initialProblem, solution: '', users: '', timeframe: '', budget: '' };
        addMessage(copy.qualification.intro);
        askQualificationQuestion(initialProblem ? 'solution' : 'problem');
    };
    const continueQualification = (answer) => {
        if (!qualification || !qualificationField) return false;
        qualification[qualificationField] = answer;
        const order = ['problem','solution','users','timeframe','budget'];
        const next = order[order.indexOf(qualificationField) + 1];
        if (next) askQualificationQuestion(next);
        else { qualificationField = null; renderLeadSummary(); }
        return true;
    };

    const scoreProjects = (query) => {
        const normalizedQuery = normalize(query);
        const words = normalizedQuery.split(' ').filter((word) => word.length > 2);
        const boostedSlugs = new Set();
        Object.entries(intentKeywords).forEach(([intent, keywords]) => {
            if (keywords.some((keyword) => normalizedQuery.includes(normalize(keyword)))) (projectHints[intent] || []).forEach((slug) => boostedSlugs.add(slug));
        });
        return projects.map((project) => {
            const haystack = normalize([project.name, project.type, project.summary, project.signal, ...(project.stack || []), ...(project.capabilities || [])].join(' '));
            let score = boostedSlugs.has(project.slug) ? 4 : 0;
            words.forEach((word) => { if (haystack.includes(word)) score += 1; });
            if (normalizedQuery.includes(normalize(project.name))) score += 8;
            return { ...project, score };
        }).filter((project) => project.score > 0).sort((a, b) => b.score - a.score);
    };

    const hasLocalLeadIntent = (query) => {
        const q = normalize(query);
        const commercial = ['cotizar','cotizacion','presupuesto','proyecto','contratar','cuanto cuesta','precio','quote','estimate','budget','project','hire','how much','price'];
        const need = ['necesito','quiero','busco','i need','i want','looking for'];
        const solution = ['app','sistema','system','plataforma','platform','software','automatizar','automate','integracion','integration','api','citas','appointments','pagos','payments','biometria','biometrics'];
        return commercial.some((term) => q.includes(term)) || (need.some((term) => q.includes(term)) && solution.some((term) => q.includes(term)));
    };

    const localFallback = (query) => {
        const q = normalize(query);
        if (['contacto','contactar','whatsapp','correo','email','contact','reach'].some((word) => q.includes(word))) return { message: copy.server.browser_contact, projects: [], show_contact: true, lead_intent: hasLocalLeadIntent(query) };
        const matches = scoreProjects(query).slice(0, 3);
        if (matches.length) return { message: copy.server.browser_matches.replace(':projects', matches.map((project) => project.name).join(', ')), projects: matches, show_contact: false, lead_intent: hasLocalLeadIntent(query) };
        return { message: copy.server.browser_fallback, projects: [], show_contact: false, lead_intent: hasLocalLeadIntent(query) };
    };

    const renderReply = (reply) => {
        addMessage(reply.message || copy.generic);
        if (Array.isArray(reply.projects) && reply.projects.length) addProjectLinks(reply.projects);
        if (reply.show_contact) addContactActions();
    };

    const askServer = async (query) => {
        if (!endpoint) return localFallback(query);
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify({ message: query }),
        });
        if (!response.ok) throw new Error(`Chat request failed with ${response.status}`);
        return response.json();
    };

    const submitQuery = async (query) => {
        collapseQuickOptions(); addMessage(query, 'user'); input.value = '';
        if (continueQualification(query)) { input.focus(); return; }
        input.disabled = true; submit.disabled = true; submit.textContent = '...';
        const pending = addMessage(copy.pending);
        try {
            const reply = await askServer(query); pending.remove(); renderReply(reply);
            if (reply.lead_intent && !qualification) startQualification(query);
        } catch {
            pending.remove(); const reply = localFallback(query); renderReply(reply);
            if (reply.lead_intent && !qualification) startQualification(query);
        } finally {
            input.disabled = false; submit.disabled = false; submit.textContent = copy.send; input.focus();
        }
    };

    toggle.addEventListener('click', () => setOpen(!chat.classList.contains('is-open')));
    close.addEventListener('click', () => setOpen(false));
    externalOpeners.forEach((button) => button.addEventListener('click', () => setOpen(true)));
    optionsToggle?.addEventListener('click', () => setQuickOptions(options.hidden));
    topicButtons.forEach((button) => button.addEventListener('click', () => {
        const topic = button.dataset.chatTopic;
        collapseQuickOptions(); addMessage(button.textContent.trim(), 'user');
        if (topic === 'lead') { startQualification(); input.focus(); return; }
        addMessage(copy.quick_replies[topic] || copy.generic);
        if (topic === 'projects') addProjectLinks(projects);
        if (topic === 'contact') addContactActions();
    }));
    form?.addEventListener('submit', (event) => {
        event.preventDefault();
        const query = input.value.trim();
        if (!query || submit.disabled) return;
        submitQuery(query);
    });
    document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && chat.classList.contains('is-open')) setOpen(false); });
}
