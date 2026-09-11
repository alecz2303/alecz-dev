# Alecz Portfolio — TODO / Launch Roadmap

Jira es la fuente de verdad para IDs y estados. Este archivo mantiene la dirección canónica del tramo de lanzamiento.

## Completado

- [x] AL-1 a AL-17 — Base, sistema visual, proyectos, case studies, About/stack, SEO, contacto privacy-first, chatbot, lead qualification, media-ready case studies, copy, ES/EN, servicios y Command Dock.
- [x] AL-18 — Primera evidencia visual real: captura segura de registro biométrico de SchoolBio.

## En ejecución

- [ ] AL-19 — Auditoría visual de repositorios y previews editoriales derivados de código verificable.
  - [x] Citas CRIT — `CODE-DERIVED PREVIEW` respaldado por Jetpack Compose (`AppContent`, `PerfilResumen`, `CitaCard`).
  - [x] SchoolBio — `REAL SCREENSHOT` seguro ya integrado por AL-18.
  - [x] Baseball App — `CODE-DERIVED PREVIEW` respaldado por Flutter (`HomeScreen` y navegación real).
  - [x] DocTotal — `CODE-DERIVED PREVIEW` respaldado por layouts/dashboard Blade y assets de branding reales del repo.
  - [x] URPE Gestión Clínica — `CODE-DERIVED PREVIEW` respaldado por dashboard, agenda y bitácoras Blade.
  - [x] AcadControl — `NO PUBLIC VISUAL`; no se localizó un repositorio con UI suficientemente verificable en la conexión actual. Se conserva fallback.

## Tramo restante antes del lanzamiento

### Contacto y conversión — alta prioridad
- [ ] Definir y configurar WhatsApp público definitivo.
- [ ] Definir y configurar correo público definitivo.
- [ ] Revisar CTAs y handoff ES/EN.

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

## Definición de terminado

El portafolio está listo cuando funciona en ambos idiomas, los proyectos tienen evidencia visual suficiente o fallback aprobado, un prospecto entiende qué construye Alecz y puede iniciar contacto sin fricción, y SEO/rendimiento/accesibilidad/QA están verificados con CI verde.
