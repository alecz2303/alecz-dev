const chat = document.querySelector('[data-chat]');

if (chat) {
    const servicesUrl = chat.dataset.servicesUrl || '';
    const servicesLabel = chat.dataset.servicesLabel || '';
    const messages = chat.querySelector('[data-chat-messages]');

    chat.querySelector('[data-chat-topic="services"]')?.addEventListener('click', () => {
        if (!servicesUrl || !messages) return;
        const link = document.createElement('a');
        link.className = 'chat-inline-link';
        link.href = servicesUrl;
        link.textContent = `${servicesLabel} →`;
        messages.appendChild(link);
        messages.scrollTop = messages.scrollHeight;
    });
}
