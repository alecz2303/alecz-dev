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
- [x] AL-16 — Servicios bilingües y posicionamiento comercial respaldado por proyectos reales.
- [x] AL-17 — Command Dock persistente, sección activa y control `↑ root` accesible.

### En ejecución

- [ ] AL-18 — Integración de evidencia visual real. SchoolBio ya tiene una captura segura integrada en la rama; los demás proyectos conservan fallback al no existir todavía media verificada y publicable.

## Tramo restante antes del lanzamiento

El orden puede ajustarse si aparece una dependencia real. Las claves Jira se crean únicamente cuando cada bloque vaya a ejecutarse.

### 1. Español / English — completado
- [x] Localización nativa de Laravel para `es` y `en`.
- [x] Home, case studies, chatbot, SEO, sitemap y `hreflang` en ambos idiomas.

### 2. Servicios / Qué puedo construir — completado
- [x] Sección comercial bilingüe de capacidades contratables.
- [x] Soluciones web/SaaS, mobile, sistemas especializados, integraciones/automatización, software + hardware y producto a medida.
- [x] Capacidades conectadas con proyectos reales como evidencia.
- [x] CTA hacia chatbot/contacto y acceso desde navegación.
- [x] Sin precios inventados ni exposición de repositorios/código.

### 3. Navegación persistente — completado
- [x] Command Dock flotante después del hero.
- [x] Acceso permanente a Projects, Services, About y Contact.
- [x] Indicador de sección activa y control `↑ root`.
- [x] Variante responsive sin competir con el chatbot.
- [x] Reduced motion, teclado y etiquetas accesibles.

### 4. Evidencia visual real — en ejecución · alta prioridad
- [ ] Incorporar capturas reales de Citas CRIT — fallback conservado; no se encontró media verificada y publicable en esta revisión.
- [x] Incorporar captura real de Digital Persona SchoolBio — registro biométrico sin datos identificables, optimizado a WebP.
- [ ] Incorporar capturas reales de Baseball App — fallback conservado; no se encontró media verificada y publicable en esta revisión.
- [ ] Incorporar capturas reales de DocTotal — fallback conservado; no se encontró media verificada y publicable en esta revisión.
- [ ] Incorporar capturas reales de URPE Gestión Clínica — fallback conservado; no se encontró media verificada y publicable en esta revisión.
- [ ] Incorporar capturas reales de AcadControl / suite académica — fallback conservado; no se encontró media verificada y publicable en esta revisión.
- [x] Optimizar formato/tamaño de la evidencia integrada y añadir `alt` y caption ES/EN.
- [x] Mantener fallback editorial donde todavía no exista media aprobada.

**Regla:** nunca inventar screenshots, clientes, métricas o resultados. Una captura existente se descarta si expone datos personales, cuentas, información clínica, credenciales o contexto interno no apto para publicación.

### 5. Contacto y conversión — alta prioridad
- [ ] Definir y configurar WhatsApp público definitivo.
- [ ] Definir y configurar correo público definitivo.
- [ ] Revisar CTAs de home, servicios, case studies y chatbot.
- [ ] Validar mensajes precompuestos de WhatsApp/email en español e inglés.
- [ ] Mantener privacidad y evitar persistencia innecesaria de conversaciones.

### 6. CV / perfil profesional — prioridad media
- [ ] Definir si habrá CV descargable, página profesional o ambos.
- [ ] Preparar contenido consistente con About/Experience sin duplicación excesiva.
- [ ] Preparar versión ES/EN si se publica como parte del sitio.
- [ ] Evitar información privada innecesaria.

### 7. SEO y social sharing — prioridad media
- [ ] Añadir datos estructurados Schema.org apropiados.
- [ ] Diseñar imagen Open Graph/social share de Alecz.
- [ ] Validar previews de home y case studies.
- [ ] Revisar titles/descriptions ES/EN en producción.
- [ ] Revisar indexación, canonical, sitemap y `hreflang` en dominio público.

### 8. Production readiness — alta prioridad
- [ ] Definir dominio público y configuración de producción.
- [ ] Configurar variables de entorno sin secretos en repositorio.
- [ ] Configurar proveedor remoto del chatbot solo si aporta valor al lanzamiento.
- [ ] Revisar caché, logs, errores, headers y configuración segura.
- [ ] Optimizar assets y rendimiento.
- [ ] Definir analítica mínima respetuosa con privacidad si se desea medir conversión.
- [ ] Verificar robots/sitemap en entorno real.

### 9. QA y lanzamiento — bloque final
- [ ] QA desktop, tablet y móvil.
- [ ] QA Español / English.
- [ ] Navegación, enlaces, case studies y media.
- [ ] Chatbot, fallback, calificación y handoff.
- [ ] 404, errores y estados sin canales configurados.
- [ ] Accesibilidad básica y SEO técnico final.
- [ ] Build y suite de pruebas verdes.
- [ ] Checklist de lanzamiento y smoke test en producción.

## Definición de terminado

El portafolio se considera listo para lanzamiento cuando la experiencia principal funciona en ambos idiomas, los proyectos prioritarios tienen evidencia visual suficiente o fallback aprobado, un prospecto entiende qué construye Alecz y puede iniciar contacto sin fricción, no se expone información interna, y SEO/rendimiento/accesibilidad/QA están verificados con CI verde.

## Principios editoriales

- El problema del cliente importa; el copy nunca debe decidir si una necesidad “vale la pena”.
- Hablar de necesidades, resultados y productos antes que de frameworks.
- Mostrar trabajo real sin exagerar ni inventar evidencia.
- Mantener un tono seguro y profesional, no arrogante.
- Español e inglés deben comunicar la misma intención, no traducirse palabra por palabra cuando eso empeore el mensaje.
