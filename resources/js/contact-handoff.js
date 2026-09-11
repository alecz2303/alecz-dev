const chat = document.querySelector('[data-chat]');

if (chat) {
    const messages = chat.querySelector('[data-chat-messages]');
    const isEnglish = document.documentElement.lang === 'en';
    const intro = isEnglish
        ? 'Hi Alecz, I would like to talk about this project:'
        : 'Hola Alecz, me gustaría platicar sobre este proyecto:';
    const copyLabel = isEnglish ? 'Copy project summary' : 'Copiar resumen del proyecto';
    const copiedLabel = isEnglish ? 'Summary copied' : 'Resumen copiado';

    const enhanceSummary = (summaryCard) => {
        if (summaryCard.dataset.handoffEnhanced === 'true') return;

        const pre = summaryCard.querySelector('pre');
        if (!pre) return;

        if (!pre.textContent.startsWith(intro)) {
            pre.textContent = `${intro}\n\n${pre.textContent}`;
        }

        const addCopyAction = () => {
            if (!messages) return false;

            const actionGroups = [...messages.querySelectorAll('.chat-contact-actions')];
            let actions = actionGroups.at(-1);

            if (!actions) {
                actions = document.createElement('div');
                actions.className = 'chat-contact-actions';
                messages.appendChild(actions);
            }

            if (actions.querySelector('[data-copy-lead-summary]')) return true;

            const button = document.createElement('button');
            button.type = 'button';
            button.dataset.copyLeadSummary = 'true';
            button.textContent = copyLabel;
            button.addEventListener('click', async () => {
                try {
                    await navigator.clipboard.writeText(pre.textContent);
                    button.textContent = copiedLabel;
                    window.setTimeout(() => { button.textContent = copyLabel; }, 1800);
                } catch {
                    pre.setAttribute('tabindex', '-1');
                    pre.focus();
                }
            });
            actions.appendChild(button);
            messages.scrollTop = messages.scrollHeight;
            return true;
        };

        summaryCard.dataset.handoffEnhanced = 'true';
        window.setTimeout(addCopyAction, 0);
    };

    const enhanceExisting = () => messages?.querySelectorAll('.chat-lead-summary').forEach(enhanceSummary);
    enhanceExisting();

    if (messages) {
        new MutationObserver(enhanceExisting).observe(messages, { childList: true, subtree: true });
    }
}
