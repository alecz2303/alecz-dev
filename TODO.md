# Alecz Portfolio — TODO / Launch Roadmap

Jira es la fuente de verdad para IDs y estados. Este archivo mantiene la dirección canónica del tramo de lanzamiento.

## Completado

- [x] AL-1 a AL-17 — Base, sistema visual, proyectos, case studies, About/stack, SEO, contacto privacy-first, chatbot, lead qualification, media-ready case studies, copy, ES/EN, servicios y Command Dock.
- [x] AL-18 — Primera evidencia visual real: captura segura de registro biométrico de SchoolBio.
- [x] AL-19 — Auditoría visual y previews editoriales derivados de código verificable; SchoolBio conserva `REAL SCREENSHOT` y AcadControl mantiene fallback `NO PUBLIC VISUAL`.
- [x] AL-20 — Contacto y conversión bilingüe: CTA de case studies, handoff localizado, resumen copiable y canales configurables sin enlaces rotos.
- [x] AL-21 — Command Dock disponible también en case studies ES/EN.

## En ejecución

- [ ] AL-22 — Perfil profesional bilingüe y arquitectura CV-ready.
  - [x] Perfil basado únicamente en experiencia demostrada por proyectos reales.
  - [x] Síntesis de producto end-to-end, amplitud técnica y proceso de ingeniería.
  - [x] Equivalencia factual ES/EN.
  - [x] CV opcional mediante `PORTFOLIO_CV_PATH`.
  - [x] El enlace de CV solo aparece cuando existe un archivo público real.
  - [ ] Incorporar CV definitivo cuando Alecz apruebe el archivo público.

## Tramo restante antes del lanzamiento

### Contacto público — pendiente de datos definitivos
- [ ] Definir y configurar WhatsApp público definitivo.
- [ ] Definir y configurar correo público definitivo.

### CV — pendiente de archivo definitivo
- [ ] Preparar/aprobar el PDF final.
- [ ] Publicarlo y configurar `PORTFOLIO_CV_PATH`.

### SEO y social sharing — siguiente bloque técnico
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

Cada visual público se clasifica como `REAL SCREENSHOT`, `REAL ASSET`, `CODE-DERIVED PREVIEW` o `NO PUBLIC VISUAL`. Un preview derivado puede simplificar editorialmente la interfaz, pero debe basarse en estructura/componentes verificables del producto, identificarse como representación y nunca fingir ser una captura de ejecución.

## Regla de contacto y perfil

Los canales públicos y el CV son configuración, no contenido asumido. Nunca se hardcodea un teléfono, correo o archivo profesional no aprobado. El perfil no inventa empleadores, estudios, certificaciones, fechas, años de experiencia, clientes, métricas ni resultados.

## Definición de terminado

El portafolio está listo cuando funciona en ambos idiomas, los proyectos tienen evidencia visual suficiente o fallback aprobado, un prospecto entiende qué construye Alecz y puede iniciar contacto sin fricción, y SEO/rendimiento/accesibilidad/QA están verificados con CI verde.
