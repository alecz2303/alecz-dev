<?php

return [
    'meta' => [
        'default_description' => 'Professional portfolio of Alejandro Fedle Rueda Jiménez, AKA Alecz. Software Developer and Product Builder focused on digital solutions for real-world problems.',
        'short_description' => 'Professional portfolio of Alecz. Software Developer and Product Builder.',
        'home_description' => 'Portfolio of Alejandro Fedle Rueda Jiménez, AKA Alecz. Software Developer and Product Builder focused on mobile products, SaaS, biometrics and integrations.',
        'home_og' => 'Real products, case studies and experience building software that solves concrete problems.',
    ],
    'nav' => [
        'skip' => 'Skip to content', 'home' => 'Alecz, home', 'open' => 'Open navigation', 'label' => 'Primary navigation',
        'projects' => '~/projects', 'about' => '~/about', 'contact' => '~/contact', 'language' => 'Español', 'language_label' => 'Switch language to Spanish',
    ],
    'home' => [
        'hero' => [
            'kicker' => 'Available to build solutions that matter',
            'lead' => 'I turn real-world problems into software that works.',
            'support' => 'I design and build complete digital products: from the idea and architecture to an experience ready to be used.',
            'projects' => 'View projects', 'about' => 'About me', 'role' => 'Software Developer · Product Builder',
        ],
        'projects' => [
            'title' => 'Real work. Working products.',
            'intro' => 'Mobile, SaaS, biometrics, clinical software and academic platforms. Every project starts with a concrete need and turns it into a useful product for the real world.',
            'problem' => 'PROBLEM', 'solution' => 'SOLUTION', 'case_study' => 'View case study →', 'more' => 'I have also built.',
        ],
        'about' => [
            'title' => 'Code with business context.',
            'p1' => 'I like to understand the problem, turn it into a useful experience and build the complete product: logic, interface, data, integrations, testing and deployment.',
            'p2' => 'I have worked on mobile products, SaaS, clinical management, academic platforms and biometric systems. That variety pushes me to think beyond the framework and choose technology based on what the product actually needs.',
            'principles' => [
                ['title' => 'Product before code', 'text' => 'First I understand who we are building for, what they need and what outcome they are looking for.'],
                ['title' => 'End to end', 'text' => 'I can move from architecture and backend to mobile, frontend, integrations and delivery.'],
                ['title' => 'Iterate with discipline', 'text' => 'I work with tickets, tests, CI, PR review and small changes that can be verified.'],
            ],
        ],
        'stack' => [
            'title' => 'Technology as a tool.',
            'intro' => 'This is not a collection of logos. It is the toolset I use to move products from an idea into production.',
            'cards' => [
                ['label'=>'BACKEND · WEB','title'=>'Laravel · PHP · Blade','text'=>'SaaS architecture, security, business processes, APIs, dashboards and maintainable web products.','items'=>['Laravel','PHP','Blade','JavaScript']],
                ['label'=>'MOBILE','title'=>'Flutter · Dart','text'=>'Android apps with state, persistence, exports, monetization and external service integrations.','items'=>['Flutter','Dart','Android','IAP']],
                ['label'=>'DESKTOP · HARDWARE','title'=>'C# · .NET · Biometrics','text'=>'Windows clients connected to biometric hardware, local repositories and remote services.','items'=>['C#','WinForms','.NET Framework','Digital Persona']],
                ['label'=>'DATA · INTEGRATIONS','title'=>'MySQL · SQLite · APIs','text'=>'Data modeling, synchronization, Google Drive, LMS, WhatsApp and third-party services.','items'=>['MySQL','SQLite','REST APIs','Google Drive']],
                ['label'=>'DELIVERY','title'=>'GitHub · CI · Jira','text'=>'Small branches, consolidated commits, automated tests, pull requests and traceable delivery.','items'=>['GitHub Actions','Git','Jira','PR Review']],
            ],
        ],
        'experience' => [
            'title' => 'Build. Learn. Repeat.',
            'intro' => 'My path is best understood through the problems I have solved and the systems I have kept pushing further.',
            'items' => [
                ['label'=>'PRODUCTS','title'=>'From real needs to usable software','text'=>'Citas CRIT, DocTotal, URPE, AcadControl and PartyX come from concrete workflows for people and organizations, not portfolio exercises.'],
                ['label'=>'MOBILE','title'=>'Apps with product depth','text'=>'Baseball App combines complex sports logic, statistics, PDF/Excel files, Drive backup and a Free/Pro model; Citas CRIT turns a family need into a published app.'],
                ['label'=>'INTEGRATIONS','title'=>'Software that works with other systems','text'=>'I have connected APIs, messaging services, LMS platforms, cloud storage, payments and biometric hardware to close complete workflows.'],
                ['label'=>'ENGINEERING','title'=>'A verifiable engineering process','text'=>'I build with GitHub, Jira, CI, tests and human PR review to preserve context, quality and traceability as the product grows.'],
            ],
        ],
        'contact' => [
            'title' => 'What do you need to solve?',
            'text' => 'Tell the site assistant. It can guide you through projects, capabilities and the best way to start a conversation with me.',
            'whatsapp' => 'Message on WhatsApp ↗', 'email' => 'Send email', 'assistant' => 'Open assistant',
            'pending' => 'WhatsApp and email will appear here when configured. The assistant can already help you explore the portfolio.',
        ],
    ],
    'case' => [
        'back' => '← Back to ~/projects', 'snapshot' => 'Product snapshot', 'proof' => 'What already exists',
        'proof_label' => 'Functional evidence for this project',
        'proof_note' => 'The visual presentation uses only real project capabilities and data. Screenshots are shown only when media is configured.',
        'visual_label' => 'Visual summary of :project based on real project information', 'gallery' => ':project gallery',
        'context' => 'The context.', 'problem' => 'The problem.', 'solution' => 'The solution.', 'problem_solution' => 'Problem and solution',
        'capabilities' => 'What it solves.', 'capabilities_intro' => 'Implemented capabilities that are part of the product and its real operation.',
        'architecture' => 'How it is built.', 'architecture_intro' => 'The architecture is explained through responsibilities and integrations, not a list of technical buzzwords.',
        'stack' => 'Stack.', 'previous' => '← Previous', 'next' => 'Next →', 'pagination' => 'Project navigation',
    ],
    'chat' => [
        'launcher' => 'Talk to the assistant', 'panel_label' => 'Portfolio assistant', 'title' => 'Alecz Assistant', 'close' => 'Close assistant',
        'welcome' => 'Hi. Tell me what you need to build or improve. I can connect your need with real Alecz projects and, if you are looking for a quote, prepare the context for a conversation with him.',
        'topics' => ['projects'=>'View projects','services'=>'What can he build?','lead'=>'I want to quote a project','contact'=>'I want to contact him'],
        'options' => 'Options', 'hide_options' => 'Hide options', 'input_label' => 'Describe what you need', 'placeholder' => 'e.g. I need an app for appointments and payments', 'send' => 'Send',
        'privacy' => 'This conversation is not stored in a database. You do not need to share sensitive data. It is only processed to respond and, if you choose, prepare a summary to contact Alecz.',
        'qualification' => [
            'problem'=>'What problem or process do you want to solve? Tell me in one or two sentences.',
            'solution'=>'What kind of solution do you imagine: mobile app, web platform, integration, automation or something else?',
            'users'=>'Who would use it? For example: customers, internal staff, patients, students or families.',
            'timeframe'=>'Do you have an approximate timeframe for a first working version?',
            'budget'=>'Do you have an approximate budget? It is completely optional; you can answer “to be defined”.',
            'intro'=>'Great. I will ask a few short questions so Alecz receives the project context without making you explain it again. You do not need to share sensitive data.',
        ],
        'summary' => ['heading'=>'Summary for Alecz','title'=>'Project inquiry from the Alecz portfolio','problem'=>'Problem','solution'=>'Solution type','users'=>'Users','timeframe'=>'Timeframe','budget'=>'Budget','undefined'=>'To be defined','ready'=>'Done. I did not store these answers. If you want, you can send this summary directly and continue the conversation with Alecz.'],
        'actions' => ['wa_summary'=>'Send summary on WhatsApp ↗','wa'=>'Open WhatsApp ↗','mail_summary'=>'Send summary by email','mail'=>'Send email','mail_subject'=>'Project inquiry from the portfolio','no_channel'=>'The summary is ready, but Alecz has not published a direct contact channel in this portfolio yet. You can copy it or come back when WhatsApp or email is enabled.'],
        'pending' => 'Analyzing your need…', 'generic' => 'I can help you explore the portfolio.',
        'quick_replies' => [
            'projects'=>'Alecz has built mobile products, SaaS, clinical software, academic platforms and biometric solutions. You can open each case study to see the problem, solution, capabilities and architecture.',
            'services'=>'He can build Laravel web products, Flutter mobile apps, API and external-service integrations, management systems and solutions that connect software with hardware or real workflows.',
            'contact'=>'Great. I will show you the direct channels Alecz has chosen to publish for this portfolio.',
        ],
        'server' => [
            'contact'=>'Yes. If Alecz has direct channels enabled, I will show them here. If you want a quote, I can also ask a few short questions and prepare the project context.',
            'services'=>'Alecz builds web and mobile products, management systems, automations and integrations across APIs, external services, data and hardware. If you tell me the problem, I can connect it with real portfolio experience.',
            'matches'=>'Based on what you describe, I would look at :projects. These are real projects that cover similar parts of the problem. You can open their case studies to see context, solution and architecture without exposing source code.',
            'fallback'=>'I do not have a clear match yet. Tell me what process you want to improve, who would use it and whether you imagine an app, web platform, integration or automation. That will help me guide you better.',
            'browser_contact'=>'Yes. If Alecz has direct channels enabled, I will show them here.',
            'browser_matches'=>'Based on what you describe, I would look at :projects. These are real projects with similar problems.',
            'browser_fallback'=>'I could not reach the server assistant right now. Tell me what process you want to improve, who would use it and whether you imagine an app, web platform, integration or automation.',
        ],
    ],
];
