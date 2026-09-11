<?php

return [
    'meta' => [
        'default_description' => 'Portafolio profesional de Alejandro Fedle Rueda Jiménez, AKA Alecz. Software Developer y Product Builder enfocado en soluciones digitales para problemas reales.',
        'short_description' => 'Portafolio profesional de Alecz. Software Developer y Product Builder.',
        'home_description' => 'Portafolio de Alejandro Fedle Rueda Jiménez, AKA Alecz. Software Developer y Product Builder enfocado en productos móviles, SaaS, biometría e integraciones.',
        'home_og' => 'Productos reales, case studies y experiencia construyendo software que resuelve problemas concretos.',
    ],
    'nav' => [
        'skip' => 'Saltar al contenido', 'home' => 'Alecz, inicio', 'open' => 'Abrir navegación', 'label' => 'Navegación principal',
        'projects' => '~/projects', 'about' => '~/about', 'contact' => '~/contact', 'language' => 'English', 'language_label' => 'Cambiar idioma a inglés',
    ],
    'home' => [
        'hero' => [
            'kicker' => 'Disponible para construir soluciones que importan',
            'lead' => 'Convierto problemas reales en software que funciona.',
            'support' => 'Diseño y desarrollo productos digitales completos: desde la idea y la arquitectura hasta una experiencia lista para usarse.',
            'projects' => 'Ver proyectos', 'about' => 'Conocerme',
            'role' => 'Software Developer · Product Builder',
        ],
        'projects' => [
            'title' => 'Trabajo real. Productos en funcionamiento.',
            'intro' => 'Mobile, SaaS, biometría, software clínico y plataformas académicas. Cada proyecto parte de una necesidad concreta y busca convertirla en un producto útil en el mundo real.',
            'problem' => 'PROBLEMA', 'solution' => 'SOLUCIÓN', 'case_study' => 'Ver case study →', 'more' => 'También he construido.',
        ],
        'about' => [
            'title' => 'Código con contexto de negocio.',
            'p1' => 'Me gusta entender el problema, aterrizarlo a una experiencia útil y construir el producto completo: lógica, interfaz, datos, integraciones, pruebas y despliegue.',
            'p2' => 'He trabajado en productos móviles, SaaS, gestión clínica, plataformas académicas y sistemas biométricos. Esa variedad me obliga a pensar más allá del framework y a elegir la tecnología según lo que el producto necesita.',
            'principles' => [
                ['title' => 'Producto antes que código', 'text' => 'Primero entiendo para quién construimos, qué necesita y qué resultado busca.'],
                ['title' => 'Extremo a extremo', 'text' => 'Puedo moverme desde arquitectura y backend hasta mobile, frontend, integraciones y entrega.'],
                ['title' => 'Iterar con disciplina', 'text' => 'Trabajo por tickets, pruebas, CI, revisión de PR y cambios pequeños que puedan verificarse.'],
            ],
        ],
        'stack' => [
            'title' => 'Tecnología como herramienta.',
            'intro' => 'No es una colección de logos. Es el conjunto de herramientas que uso para llevar productos desde la idea hasta producción.',
            'cards' => [
                ['label'=>'BACKEND · WEB','title'=>'Laravel · PHP · Blade','text'=>'Arquitectura SaaS, seguridad, procesos de negocio, APIs, paneles y productos web mantenibles.','items'=>['Laravel','PHP','Blade','JavaScript']],
                ['label'=>'MOBILE','title'=>'Flutter · Dart','text'=>'Apps Android con estado, persistencia, exportaciones, monetización e integración con servicios externos.','items'=>['Flutter','Dart','Android','IAP']],
                ['label'=>'DESKTOP · HARDWARE','title'=>'C# · .NET · Biometría','text'=>'Clientes Windows conectados con hardware biométrico, repositorios locales y servicios remotos.','items'=>['C#','WinForms','.NET Framework','Digital Persona']],
                ['label'=>'DATA · INTEGRATIONS','title'=>'MySQL · SQLite · APIs','text'=>'Modelado de datos, sincronización, Google Drive, LMS, WhatsApp y servicios de terceros.','items'=>['MySQL','SQLite','REST APIs','Google Drive']],
                ['label'=>'DELIVERY','title'=>'GitHub · CI · Jira','text'=>'Ramas pequeñas, commits consolidados, pruebas automatizadas, pull requests y trazabilidad de trabajo.','items'=>['GitHub Actions','Git','Jira','PR Review']],
            ],
        ],
        'experience' => [
            'title' => 'Construir. Aprender. Repetir.',
            'intro' => 'Mi trayectoria se entiende mejor por los problemas que he resuelto y los sistemas que he llevado cada vez más lejos.',
            'items' => [
                ['label'=>'PRODUCTS','title'=>'De necesidades reales a software utilizable','text'=>'Citas CRIT, DocTotal, URPE, AcadControl y PartyX nacen de flujos concretos de personas y organizaciones, no de ejercicios de portafolio.'],
                ['label'=>'MOBILE','title'=>'Apps con profundidad de producto','text'=>'Baseball App combina lógica deportiva compleja, estadísticas, archivos PDF/Excel, backup en Drive y modelo Free/Pro; Citas CRIT lleva una necesidad familiar a una app publicada.'],
                ['label'=>'INTEGRATIONS','title'=>'Software que conversa con otros sistemas','text'=>'He conectado APIs, servicios de mensajería, LMS, almacenamiento en la nube, pagos y hardware biométrico para cerrar procesos completos.'],
                ['label'=>'ENGINEERING','title'=>'Proceso técnico verificable','text'=>'Desarrollo con GitHub, Jira, CI, pruebas y revisión humana de PR para mantener contexto, calidad y trazabilidad mientras el producto crece.'],
            ],
        ],
        'contact' => [
            'title' => '¿Qué necesitas resolver?',
            'text' => 'Cuéntaselo al asistente del sitio. Puede orientarte entre proyectos, capacidades y la mejor forma de iniciar una conversación conmigo.',
            'whatsapp' => 'Escribir por WhatsApp ↗', 'email' => 'Enviar correo', 'assistant' => 'Abrir asistente',
            'pending' => 'WhatsApp y correo se activarán aquí cuando estén configurados. El asistente ya puede ayudarte a explorar el portafolio.',
        ],
    ],
    'case' => [
        'back' => '← Volver a ~/projects', 'snapshot' => 'Product snapshot', 'proof' => 'Lo que ya existe',
        'proof_label' => 'Evidencia funcional del proyecto',
        'proof_note' => 'La presentación visual usa únicamente capacidades y datos reales del proyecto. Las capturas se muestran solo cuando existe media configurada.',
        'visual_label' => 'Resumen visual de :project basado en información real del proyecto', 'gallery' => 'Galería de :project',
        'context' => 'El contexto.', 'problem' => 'El problema.', 'solution' => 'La solución.', 'problem_solution' => 'Problema y solución',
        'capabilities' => 'Qué resuelve.', 'capabilities_intro' => 'Capacidades implementadas que forman parte del producto y su operación real.',
        'architecture' => 'Cómo está construido.', 'architecture_intro' => 'La arquitectura se explica por responsabilidades e integraciones, no por una lista de términos técnicos.',
        'stack' => 'Stack.', 'previous' => '← Anterior', 'next' => 'Siguiente →', 'pagination' => 'Navegación entre proyectos',
    ],
    'chat' => [
        'launcher' => 'Hablar con el asistente', 'panel_label' => 'Asistente del portafolio', 'title' => 'Asistente de Alecz', 'close' => 'Cerrar asistente',
        'welcome' => 'Hola. Cuéntame qué necesitas construir o mejorar. Puedo relacionarlo con proyectos reales de Alecz y, si buscas cotizar, preparar el contexto para hablar con él.',
        'topics' => ['projects'=>'Ver proyectos','services'=>'¿Qué puede construir?','lead'=>'Quiero cotizar un proyecto','contact'=>'Quiero contactarlo'],
        'options' => 'Opciones', 'hide_options' => 'Ocultar opciones', 'input_label' => 'Escribe qué necesitas', 'placeholder' => 'Ej. Necesito una app para citas y pagos', 'send' => 'Enviar',
        'privacy' => 'No guardamos esta conversación en base de datos. No necesitas compartir datos sensibles. Solo se procesa para responder y preparar, si tú quieres, un resumen para contactar a Alecz.',
        'qualification' => [
            'problem'=>'¿Qué problema o proceso quieres resolver? Cuéntamelo en una o dos frases.',
            'solution'=>'¿Qué tipo de solución imaginas: app móvil, plataforma web, integración, automatización u otra?',
            'users'=>'¿Quiénes la usarían? Por ejemplo: clientes, personal interno, pacientes, alumnos o familias.',
            'timeframe'=>'¿Tienes algún plazo aproximado para tener una primera versión funcionando?',
            'budget'=>'¿Tienes un presupuesto aproximado? Es totalmente opcional; puedes responder “por definir”.',
            'intro'=>'Perfecto. Te haré unas preguntas breves para que Alecz reciba el contexto del proyecto sin que tengas que explicarlo otra vez. No necesitas compartir datos sensibles.',
        ],
        'summary' => ['heading'=>'Resumen para Alecz','title'=>'Consulta de proyecto desde el portafolio de Alecz','problem'=>'Problema','solution'=>'Tipo de solución','users'=>'Usuarios','timeframe'=>'Plazo','budget'=>'Presupuesto','undefined'=>'Por definir','ready'=>'Listo. No guardé estas respuestas. Si quieres, puedes enviar este resumen directamente y continuar la conversación con Alecz.'],
        'actions' => ['wa_summary'=>'Enviar resumen por WhatsApp ↗','wa'=>'Abrir WhatsApp ↗','mail_summary'=>'Enviar resumen por correo','mail'=>'Enviar correo','mail_subject'=>'Consulta de proyecto desde el portafolio','no_channel'=>'El resumen está listo, pero Alecz todavía no ha publicado un canal directo en este portafolio. Puedes copiarlo o volver cuando WhatsApp o correo estén habilitados.'],
        'pending' => 'Analizando tu necesidad…', 'generic' => 'Puedo ayudarte a explorar el portafolio.',
        'quick_replies' => [
            'projects'=>'Alecz ha construido productos móviles, SaaS, software clínico, plataformas académicas y soluciones biométricas. Puedes abrir cada case study y ver problema, solución, capacidades y arquitectura.',
            'services'=>'Puede construir productos web con Laravel, apps móviles con Flutter, integraciones con APIs y servicios externos, sistemas de gestión y soluciones que conectan software con hardware o procesos reales.',
            'contact'=>'Perfecto. Te muestro los canales directos que Alecz haya decidido publicar para este portafolio.',
        ],
        'server' => [
            'contact'=>'Sí. Si Alecz tiene canales directos habilitados, te los muestro aquí. Si quieres cotizar un proyecto, también puedo hacerte unas preguntas breves y preparar el contexto para la conversación.',
            'services'=>'Alecz construye productos web y móviles, sistemas de gestión, automatizaciones e integraciones entre APIs, servicios externos, datos y hardware. Si me cuentas el problema, puedo relacionarlo con experiencia real del portafolio.',
            'matches'=>'Por lo que describes, revisaría :projects. Son proyectos reales que cubren partes parecidas del problema. Puedes abrir sus case studies para ver contexto, solución y arquitectura sin exponer código fuente.',
            'fallback'=>'No encontré una coincidencia clara todavía. Cuéntame qué proceso quieres mejorar, quién lo usaría y si imaginas una app, plataforma web, integración o automatización. Con eso puedo orientarte mejor.',
            'browser_contact'=>'Sí. Si Alecz tiene canales directos habilitados, te los muestro aquí.',
            'browser_matches'=>'Por lo que describes, revisaría :projects. Son proyectos reales con problemas parecidos.',
            'browser_fallback'=>'No pude consultar el asistente del servidor en este momento. Cuéntame qué proceso quieres mejorar, quién lo usaría y si imaginas una app, plataforma web, integración o automatización.',
        ],
    ],
];
