# alecz-dev

Portafolio personal y sitio profesional de **Alejandro Fedle Rueda Jiménez (AKA Alecz)**.

## Stack

- Laravel 13
- PHP 8.3+
- Blade
- Vite
- Tailwind CSS 4
- JavaScript ligero

## Desarrollo local

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run build
php artisan serve
```

La aplicación usa SQLite por defecto para desarrollo. El sitio no requiere persistencia para mostrar el portafolio.

## Localización Español / English

El portafolio es bilingüe de extremo a extremo mediante la capa de traducciones de Laravel. Español conserva `/` y `/proyectos/{slug}`; inglés vive en `/en` y `/en/projects/{slug}`. El selector mantiene la página equivalente y `lang`, canonical, `og:locale`, `hreflang`, sitemap, navegación y chatbot respetan el locale activo.

Las cadenas de interfaz viven en `lang/es/ui.php` y `lang/en/ui.php`. El contenido factual de proyectos se mantiene en `config/portfolio.php` y `config/portfolio_en.php`. Ambas versiones conservan los mismos hechos y capacidades.

## Servicios y posicionamiento comercial

La home incluye `~/services`, una capa comercial que explica qué puede construir Alecz sin vender tecnologías aisladas ni publicar paquetes o precios inventados.

El contenido vive en `config/services.php` y `config/services_en.php`. Cada capacidad conecta con case studies reales mediante sus slugs y cubre web/SaaS, mobile, sistemas especializados, integraciones/automatización, software conectado con hardware y construcción/evolución de productos a medida.

La sección tiene CTA directo al asistente. El atajo de servicios del chatbot también ofrece acceso a `#servicios`, conservando el idioma activo. La presentación sigue la política privacy-first: no expone repositorios, código, Jira ni GitHub.

## Navegación persistente

El sitio conserva el header original y muestra un **Command Dock** flotante con acceso a `~/projects`, `~/services`, `~/about`, `~/contact` y `↑ root`.

En la home, el dock aparece después de abandonar el hero y marca la sección activa durante el scroll. En los case studies también permanece disponible: los accesos llevan a la sección equivalente de la home en el idioma activo y `↑ root` vuelve al inicio de la página interna actual. La implementación evita marcar una sección activa cuando esas secciones no existen en la vista actual.

La implementación vive en `resources/css/command-dock.css` y `resources/js/command-dock.js`, usa JavaScript nativo, etiquetas accesibles, se adapta a móvil, evita competir con el chatbot y respeta `prefers-reduced-motion`.

## Contenido del portafolio

Los proyectos destacados se renderizan desde estructuras reutilizables que alimentan también sus case studies. Cada proyecto puede declarar nombre, slug, tipo, estado, resumen, problema, solución, stack, señal, contexto, capacidades, arquitectura e integraciones y media visual opcional.

La vista reusable vive en `resources/views/projects/show.blade.php`. Slugs desconocidos responden 404.

### Media de proyectos

La evidencia visual pública se registra en `config/project_media.php`, separando captions y `alt` por locale y reutilizando el mismo asset factual. El case study mantiene compatibilidad con la clave `media` de cada proyecto y usa el registro como fuente aprobada cuando existe.

Estado actual: **Digital Persona SchoolBio** cuenta con una captura real, optimizada a WebP, del flujo de registro biométrico. La imagen no muestra nombre, matrícula, huella ni información identificable de un alumno. Citas CRIT, Baseball App, DocTotal y URPE Gestión Clínica cuentan con previews editoriales claramente marcados como `CODE-DERIVED PREVIEW`, derivados de estructura de UI verificable en sus repositorios. AcadControl conserva fallback al no existir todavía una interfaz pública suficientemente verificable.

No se presentan previews derivados de código como screenshots de ejecución. Los assets aprobados viven en `public/media/projects/` con rutas estables.

## Contacto y privacidad

El portafolio no publica repositorios ni enlaces al código fuente. Los canales directos se configuran por entorno:

```env
PORTFOLIO_WHATSAPP=
PORTFOLIO_EMAIL=
```

Solo se renderizan cuando existe un valor configurado.

## Asistente del portafolio

El chatbot acepta opciones rápidas y texto libre. La conversación se procesa server-side mediante `App\Services\PortfolioChatService` y respeta el idioma activo. El motor local reconoce señales en español e inglés y recomienda proyectos reales.

Configuración opcional del proveedor remoto:

```env
CHATBOT_PROVIDER=local
CHATBOT_REMOTE_URL=
CHATBOT_REMOTE_KEY=
CHATBOT_REMOTE_MODEL=
CHATBOT_REMOTE_TIMEOUT=8
```

Las claves permanecen server-side. El proveedor recibe únicamente contexto público controlado; no recibe repositorios, código fuente, secretos, Jira/GitHub interno ni credenciales. Si falla, se usa el motor local.

### Calificación de prospectos

Cuando existe intención comercial, el navegador guía una calificación breve con problema, solución, usuarios, plazo y presupuesto opcional. El resumen puede entregarse a WhatsApp o email configurados o copiarse al portapapeles. La conversación y calificación no se guardan en base de datos, `localStorage` ni `sessionStorage`.

## Publicación y SEO técnico

- `/robots.txt` controla indexación según entorno.
- `/sitemap.xml` incluye home y case studies ES/EN.
- El layout centraliza title, description, canonical, Open Graph, Twitter Card, `og:locale` y `hreflang`.
- `public/favicon.svg` contiene el brand mark `>_`.

## Roadmap

`TODO.md` es la referencia canónica del tramo restante hacia lanzamiento. Jira continúa siendo la fuente de verdad para IDs y estados de ejecución.

## Flujo de trabajo

Jira project key: `AL`. Cada cambio funcional se desarrolla en una rama asociada a su ticket y se integra mediante pull request.

## Dirección visual

El sitio combina una interfaz editorial/premium con pequeños recursos inspirados en terminal. La consola funciona como lenguaje visual, no como interfaz completa.
