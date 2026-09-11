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

## En ejecución

- [ ] AL-26 — Activar canales públicos aprobados.
  - [x] WhatsApp público definido: `+52 961 112 0913` (`529611120913` en configuración).
  - [x] Correo público definido: `me@alecz.dev`.
  - [x] Mantener ambos valores como variables de entorno y `.env.example` sin datos personales.
  - [x] Cubrir ES/EN, enlaces directos y fallback sin configuración mediante pruebas.
  - [ ] Configurar los valores en el `.env` real del servidor durante el despliegue.

## Tramo restante antes del lanzamiento

### Contacto público — datos aprobados
- [x] Definir WhatsApp público definitivo.
- [x] Definir correo público definitivo.
- [ ] Configurar `PORTFOLIO_WHATSAPP=529611120913` y `PORTFOLIO_EMAIL=me@alecz.dev` en producción.

### CV — pendiente de archivo definitivo
- [ ] Preparar/aprobar el PDF final.
- [ ] Publicarlo y configurar `PORTFOLIO_CV_PATH`.

### SEO y social sharing — validación final en producción
- [ ] Validar Open Graph/Twitter con crawlers reales una vez desplegado el dominio.
- [ ] Validar canonical, sitemap y hreflang sobre URLs públicas finales.

### Production readiness — alta prioridad
- [x] Dominio público elegido: `alecz.dev`.
- [ ] Apuntar/configurar `alecz.dev` en el hosting y completar configuración de producción.
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

Los canales públicos y el CV son configuración, no contenido asumido. Los valores aprobados de contacto pueden documentarse para despliegue, pero las vistas y lógica siguen consumiéndolos desde el entorno. El perfil no inventa empleadores, estudios, certificaciones, fechas, años de experiencia, clientes, métricas ni resultados.

## Regla de SEO estructurado

Schema.org y metadatos sociales describen únicamente información ya pública y verificable. No se usan datos estructurados para introducir perfiles externos, clientes, métricas, estudios, empleadores, premios ni contacto no aprobado.

## Definición de terminado

El portafolio está listo cuando funciona en ambos idiomas, los proyectos tienen evidencia visual suficiente o fallback aprobado, un prospecto entiende qué construye Alecz y puede iniciar contacto sin fricción, y SEO/rendimiento/accesibilidad/QA están verificados con CI verde y smoke test sobre producción.
