# Alecz Portfolio — TODO / Launch Roadmap

Este archivo es la referencia canónica del tramo restante del portafolio. Jira sigue siendo la fuente de verdad para IDs y estados de ejecución; este roadmap define dirección y orden sin reservar ni inventar claves futuras.

## Estado actual

### Completado

- [x] AL-1 — Base Laravel del portafolio.
- [x] AL-2 — Sistema visual premium y hero inspirado en terminal.
- [x] AL-3 — Proyectos destacados y estructura inicial de case studies.
- [x] AL-4 — Jerarquía completa de productos y proyectos.
- [x] AL-5 — About, stack y experiencia.
- [x] AL-6 — Case studies individuales reutilizables.
- [x] AL-7 — Contacto, SEO base y acabados de navegación.
- [x] AL-8 — Lanzamiento privacy-first, contacto configurable y chatbot.
- [x] AL-9 — Chatbot con texto libre y orientación inteligente local.
- [x] AL-10 — Servicio de chatbot server-side preparado para proveedor remoto.
- [x] AL-11 — Calificación de prospectos y handoff a contacto.
- [x] AL-12 — UX del chatbot: acciones rápidas colapsables.
- [x] AL-13 — Case studies preparados para media y evidencia visual real.
- [x] AL-14 — Revisión de copy y establecimiento de este roadmap canónico.
- [x] AL-15 — Experiencia bilingüe completa Español / English.

## Tramo restante antes del lanzamiento

El orden puede ajustarse si aparece una dependencia real. Las claves Jira se crean únicamente cuando cada bloque vaya a ejecutarse.

### 1. Español / English — completado

- [x] Localización nativa de Laravel para `es` y `en`.
- [x] Español conservado en las URLs públicas originales; inglés disponible bajo `/en`.
- [x] Selector de idioma visible, accesible y consistente.
- [x] Home completa en ambos idiomas.
- [x] Seis case studies completos en ambos idiomas.
- [x] Chatbot, calificación y handoff en el idioma activo.
- [x] Metadatos SEO, canonical, sitemap y `hreflang` coherentes por idioma.
- [x] Nombres propios, marcas y términos técnicos conservados cuando corresponde.

**Criterio:** español e inglés deben mantener la misma calidad editorial y los mismos hechos del portafolio.

### 2. Servicios / Qué puedo construir — siguiente bloque · alta prioridad

- [ ] Crear una sección comercial clara de capacidades contratables.
- [ ] Explicar soluciones web/SaaS, mobile, integraciones/automatización y sistemas a medida.
- [ ] Conectar cada capacidad con proyectos reales como evidencia.
- [ ] Evitar vender tecnologías aisladas; comunicar resultados y procesos.
- [ ] Integrar CTAs hacia chatbot/contacto.
- [ ] Mantener la sección completa en español e inglés desde el primer commit.

### 3. Evidencia visual real — alta prioridad

- [ ] Incorporar capturas reales de Citas CRIT.
- [ ] Incorporar capturas reales de Digital Persona SchoolBio.
- [ ] Incorporar capturas reales de Baseball App.
- [ ] Incorporar capturas reales de DocTotal.
- [ ] Incorporar capturas reales de URPE Gestión Clínica.
- [ ] Incorporar capturas reales de AcadControl / suite académica.
- [ ] Optimizar formatos, tamaños, `alt` y captions en ambos idiomas.
- [ ] Mantener fallback editorial donde todavía no exista media aprobada.

**Regla:** nunca inventar screenshots, clientes, métricas o resultados.

### 4. Contacto y conversión — alta prioridad

- [ ] Definir y configurar WhatsApp público definitivo.
- [ ] Definir y configurar correo público definitivo.
- [ ] Revisar CTAs de home, servicios, case studies y chatbot.
- [ ] Validar mensajes precompuestos de WhatsApp/email en español e inglés.
- [ ] Mantener privacidad y evitar persistencia innecesaria de conversaciones.

### 5. CV / perfil profesional — prioridad media

- [ ] Definir si habrá CV descargable, página profesional o ambos.
- [ ] Preparar contenido consistente con About/Experience sin duplicación excesiva.
- [ ] Preparar versión ES/EN si se publica como parte del sitio.
- [ ] Evitar información privada innecesaria.

### 6. SEO y social sharing — prioridad media

- [ ] Añadir datos estructurados Schema.org apropiados.
- [ ] Diseñar imagen Open Graph/social share de Alecz.
- [ ] Validar previews de home y case studies.
- [ ] Revisar titles/descriptions ES/EN en producción.
- [ ] Revisar indexación, canonical, sitemap y `hreflang` en dominio público.

### 7. Production readiness — alta prioridad

- [ ] Definir dominio público y configuración de producción.
- [ ] Configurar variables de entorno sin secretos en repositorio.
- [ ] Configurar proveedor remoto del chatbot solo si aporta valor al lanzamiento.
- [ ] Revisar caché, logs, errores, headers y configuración segura.
- [ ] Optimizar assets y rendimiento.
- [ ] Definir analítica mínima respetuosa con privacidad si se desea medir conversión.
- [ ] Verificar robots/sitemap en entorno real.

### 8. QA y lanzamiento — bloque final

- [ ] QA desktop, tablet y móvil.
- [ ] QA Español / English.
- [ ] Navegación y enlaces internos.
- [ ] Case studies y media.
- [ ] Chatbot, fallback, calificación y handoff.
- [ ] Estados sin WhatsApp/email configurados.
- [ ] 404 y manejo de errores.
- [ ] Accesibilidad básica: teclado, foco, labels y contraste.
- [ ] SEO técnico final.
- [ ] Build y suite de pruebas verdes.
- [ ] Checklist de lanzamiento y smoke test en producción.

## Definición de terminado

El portafolio se considera listo para lanzamiento cuando:

1. la experiencia principal está completa en español e inglés;
2. los proyectos prioritarios tienen evidencia visual real suficiente o un fallback explícitamente aprobado;
3. un prospecto entiende qué construye Alecz y puede iniciar contacto sin fricción;
4. no se exponen repositorios, código fuente, Jira, secretos ni información interna;
5. SEO, rendimiento, accesibilidad básica y QA están verificados en producción;
6. CI y pruebas están verdes sobre la versión publicada.

## Principios editoriales

- El problema del cliente importa; el copy nunca debe decidir si una necesidad “vale la pena”.
- Hablar de necesidades, resultados y productos antes que de frameworks.
- Mostrar trabajo real sin exagerar ni inventar evidencia.
- Mantener un tono seguro y profesional, no arrogante.
- Español e inglés deben comunicar la misma intención, no traducirse palabra por palabra cuando eso empeore el mensaje.
