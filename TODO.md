# Alecz Portfolio — TODO / Launch Roadmap

Jira es la fuente de verdad para IDs y estados. Este archivo mantiene la dirección canónica del tramo de lanzamiento.

## Completado

- [x] AL-1 a AL-17 — Base, sistema visual, proyectos, case studies, About/stack, SEO, contacto privacy-first, chatbot, lead qualification, media-ready case studies, copy, ES/EN, servicios y Command Dock.
- [x] AL-18 — Primera evidencia visual real: captura segura de registro biométrico de SchoolBio.
- [x] AL-19 — Auditoría visual de repositorios y previews editoriales derivados de código verificable para Citas CRIT, Baseball App, DocTotal y URPE; SchoolBio conserva `REAL SCREENSHOT` y AcadControl mantiene fallback `NO PUBLIC VISUAL`.

## En ejecución

- [ ] AL-20 — Refinamiento de contacto y conversión bilingüe.
  - [x] CTA de siguiente paso añadido a todos los case studies ES/EN.
  - [x] Handoff del chatbot enriquecido con introducción localizada para contactar a Alecz.
  - [x] Resumen del prospecto puede copiarse al portapapeles además de enviarse por canales configurados.
  - [x] WhatsApp y correo continúan siendo 100% configurables por entorno; sin valores hardcodeados.
  - [x] Cuando no existen canales configurados no se generan enlaces rotos y el asistente sigue siendo el camino disponible.
  - [ ] Configurar WhatsApp público definitivo cuando Alecz lo defina.
  - [ ] Configurar correo público definitivo cuando Alecz lo defina.

## Tramo restante antes del lanzamiento

### Contacto público — pendiente de datos definitivos
- [ ] Definir y configurar WhatsApp público definitivo.
- [ ] Definir y configurar correo público definitivo.

### CV / perfil profesional — prioridad media
- [ ] Definir CV descargable, página profesional o ambos.
- [ ] Preparar contenido ES/EN consistente con About/Experience.

### SEO y social sharing — prioridad media
- [ ] Añadir Schema.org.
- [ ] Diseñar imagen Open Graph/social share.
- [ ] Validar previews, canonical, sitemap y hreflang en producción.

### Production readiness — alta prioridad
- [ ] Definir dominio público y configuración de producción.
- [ ] Configurar variables de entorno sin secretos en repositorio.
- [ ] Evaluar proveedor remoto del chatbot.
- [ ] Revisar caché, logs, errores, headers, rendimiento y analítica privacy-safe.

### QA y lanzamiento — bloque final
- [ ] QA desktop, tablet y móvil; Español / English.
- [ ] Navegación, case studies, media, chatbot y handoff.
- [ ] 404, accesibilidad y SEO técnico final.
- [ ] Build y suite de pruebas verdes.
- [ ] Checklist y smoke test de producción.

## Regla de evidencia visual

Cada visual público se clasifica como `REAL SCREENSHOT`, `REAL ASSET`, `CODE-DERIVED PREVIEW` o `NO PUBLIC VISUAL`. Un preview derivado puede simplificar editorialmente la interfaz, pero debe basarse en estructura/componentes verificables del producto, identificarse como representación y nunca fingir ser una captura de ejecución. No se publican repositorios, código, credenciales, datos clínicos ni información identificable.

## Regla de contacto

Los canales públicos son configuración, no contenido asumido. Nunca se hardcodea un teléfono o correo sin decisión explícita de Alecz. Si un canal no está configurado, el sitio lo omite y mantiene el asistente como siguiente paso útil. La conversación y el resumen de prospecto no se persisten en base de datos ni almacenamiento del navegador.

## Definición de terminado

El portafolio está listo cuando funciona en ambos idiomas, los proyectos tienen evidencia visual suficiente o fallback aprobado, un prospecto entiende qué construye Alecz y puede iniciar contacto sin fricción, y SEO/rendimiento/accesibilidad/QA están verificados con CI verde.
