# Alecz Portfolio — TODO / Launch Roadmap

Jira es la fuente de verdad para IDs y estados. Este archivo mantiene la dirección canónica del tramo de lanzamiento.

## Completado

- [x] AL-1 a AL-17 — Base, sistema visual, proyectos, case studies, About/stack, SEO, contacto privacy-first, chatbot, lead qualification, media-ready case studies, copy, ES/EN, servicios y Command Dock.
- [x] AL-18 — Primera evidencia visual real: captura segura de registro biométrico de SchoolBio.
- [x] AL-19 — Auditoría visual y previews editoriales derivados de código verificable; SchoolBio conserva `REAL SCREENSHOT` y AcadControl mantiene fallback `NO PUBLIC VISUAL`.
- [x] AL-20 — Contacto y conversión bilingüe: CTA de case studies, handoff localizado, resumen copiable y canales configurables sin enlaces rotos.
- [x] AL-21 — Command Dock disponible también en case studies ES/EN.
- [x] AL-22 — Perfil profesional bilingüe y arquitectura CV-ready con `PORTFOLIO_CV_PATH` opcional y sin enlaces rotos.
- [x] AL-25 — SEO estructurado y social sharing: Schema.org/JSON-LD, `CreativeWork`, imagen social 1200×630 y metadatos Open Graph/Twitter. La validación sobre URLs públicas se conserva para production QA.
- [x] AL-26 — Canales públicos aprobados: WhatsApp `+52 961 112 0913` y correo `me@alecz.dev`, manteniendo configuración por entorno.

## En ejecución

- [ ] AL-27 — Production readiness para cPanel sin SSH.
  - [x] Infraestructura confirmada: `/home/alecz`, `public_html`, PHP 8.4, SSL activo y DNS resolviendo.
  - [x] Arquitectura separada definida: `/home/alecz/alecz-app` privado + `/home/alecz/public_html` público.
  - [x] Front controller de cPanel preparado.
  - [x] `.env.production.example` seguro preparado para `alecz.dev`.
  - [x] Guía de despliegue, permisos y smoke test documentados.
  - [ ] Generar paquete ZIP final con `vendor/` de producción y assets Vite compilados.
  - [ ] Subir al servidor y ejecutar smoke test de producción.

## Tramo restante antes del lanzamiento

### Contacto público
- [x] Definir WhatsApp público definitivo.
- [x] Definir correo público definitivo.
- [ ] Configurar ambos valores en el `.env` real del servidor durante AL-27.

### CV — pendiente de archivo definitivo
- [ ] Preparar/aprobar el PDF final.
- [ ] Publicarlo y configurar `PORTFOLIO_CV_PATH`.

### SEO y social sharing — validación final en producción
- [ ] Validar Open Graph/Twitter con crawlers reales una vez desplegado el dominio.
- [ ] Validar canonical, sitemap y hreflang sobre URLs públicas finales.

### Production readiness
- [x] Dominio público elegido: `alecz.dev`.
- [x] Hosting base confirmado: PHP 8.4, SSL activo y DNS resolviendo.
- [x] Estrategia cPanel/File Manager definida sin SSH.
- [ ] Desplegar paquete AL-27 y completar configuración real de producción.
- [ ] Revisar logs, headers, rendimiento y analítica privacy-safe.

### QA y lanzamiento — bloque final
- [ ] QA desktop, tablet y móvil; Español / English.
- [ ] Navegación, case studies, media, chatbot y handoff.
- [ ] 404, accesibilidad y SEO técnico final.
- [ ] Build y suite de pruebas verdes.
- [ ] Checklist y smoke test de producción.

## Regla de evidencia visual

Cada visual público se clasifica como `REAL SCREENSHOT`, `REAL ASSET`, `CODE-DERIVED PREVIEW` o `NO PUBLIC VISUAL`. Un preview derivado puede simplificar editorialmente la interfaz, pero debe basarse en estructura/componentes verificables del producto, identificarse como representación y nunca fingir ser una captura de ejecución.

## Regla de contacto y perfil

Los canales públicos y el CV son configuración, no contenido asumido. Los valores aprobados de contacto pueden documentarse para despliegue, pero las vistas y lógica siguen consumiéndolos desde el entorno. El perfil no inventa empleadores, estudios, certificaciones, fechas, años de experiencia, clientes, métricas ni resultados.

## Regla de despliegue

El `.env`, `vendor`, `storage`, código fuente interno y secretos permanecen fuera de `public_html`. En hosting sin SSH, Composer/npm se resuelven antes de generar el paquete; el servidor recibe artefactos ya listos para ejecución.

## Definición de terminado

El portafolio está listo cuando funciona en ambos idiomas, los proyectos tienen evidencia visual suficiente o fallback aprobado, un prospecto entiende qué construye Alecz y puede iniciar contacto sin fricción, y SEO/rendimiento/accesibilidad/QA están verificados con CI verde y smoke test sobre producción.
