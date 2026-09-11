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

El portafolio es bilingüe de extremo a extremo mediante la capa de traducciones de Laravel.

- Español conserva las URLs originales: `/` y `/proyectos/{slug}`.
- Inglés vive en `/en` y `/en/projects/{slug}`.
- El selector de idioma mantiene al visitante en el proyecto equivalente cuando cambia de idioma.
- `lang`, `canonical`, `og:locale`, `hreflang`, navegación y enlaces internos respetan el locale activo.
- `/sitemap.xml` incluye ambas versiones de la home y de los seis case studies destacados.
- El chatbot usa el endpoint `/chat` en español y `/en/chat` en inglés.

Las cadenas de interfaz viven en:

- `lang/es/ui.php`
- `lang/en/ui.php`

El contenido factual de proyectos se mantiene separado por idioma en:

- `config/portfolio.php`
- `config/portfolio_en.php`

Las dos versiones deben conservar los mismos hechos, capacidades, stack y jerarquía; el inglés se adapta editorialmente y no se trata como traducción literal cuando eso empeora el mensaje.

## Contenido del portafolio

Los proyectos destacados se renderizan desde una estructura reutilizable. Esa misma fuente de datos alimenta las páginas individuales de case study, evitando duplicar markup por proyecto.

Cada proyecto destacado puede declarar:

- nombre y slug
- tipo y estado
- resumen
- problema y solución
- stack tecnológico
- señal o resultado destacado
- contexto
- capacidades principales
- arquitectura e integraciones
- media visual opcional

La vista reusable de case study vive en `resources/views/projects/show.blade.php`. Los slugs desconocidos responden 404 y los proyectos válidos incluyen navegación de regreso al portafolio y entre case studies.

### Media de proyectos

Los case studies incluyen un bloque visual reusable. Mientras un proyecto no tenga capturas reales, la vista muestra un `Product snapshot` editorial construido únicamente con datos reales del proyecto. No se generan ni simulan interfaces inexistentes.

Cuando existan capturas reales se pueden añadir mediante la clave opcional `media` de cada configuración de proyecto:

```php
'media' => [
    [
        'role' => 'hero',
        'src' => 'images/projects/mi-proyecto/hero.webp',
        'alt' => 'Descripción accesible de la pantalla principal',
    ],
    [
        'src' => 'images/projects/mi-proyecto/detalle.webp',
        'alt' => 'Descripción accesible de la vista secundaria',
        'caption' => 'Texto opcional que explica qué se está mostrando.',
    ],
],
```

`role => hero` identifica la imagen principal. El resto se renderiza como galería responsive. `alt` debe describir la captura real y `caption` es opcional. Los archivos viven dentro de `public/` y la vista resuelve sus rutas con `asset()`.

## Contacto y privacidad

El portafolio no publica repositorios ni enlaces al código fuente como llamada a la acción. Los canales directos se configuran por entorno:

```env
PORTFOLIO_WHATSAPP=
PORTFOLIO_EMAIL=
```

Solo se renderizan cuando existe un valor configurado.

## Asistente del portafolio

El chatbot acepta opciones rápidas y texto libre. Las opciones rápidas funcionan como atajos de bienvenida y se colapsan en cuanto inicia la conversación.

La conversación se procesa server-side mediante `App\Services\PortfolioChatService` y respeta el idioma de la ruta activa. El motor local reconoce señales relevantes en español e inglés y usa el contenido localizado del portafolio para recomendar proyectos.

La arquitectura tiene dos modos:

1. `local` — motor determinista incluido en el proyecto. No necesita claves ni servicios externos.
2. `remote` — proveedor compatible con un payload `model` + `messages`. Si falla, tarda demasiado o devuelve una respuesta inválida, se vuelve automáticamente al motor local.

Configuración:

```env
CHATBOT_PROVIDER=local
CHATBOT_REMOTE_URL=
CHATBOT_REMOTE_KEY=
CHATBOT_REMOTE_MODEL=
CHATBOT_REMOTE_TIMEOUT=8
```

Para habilitar el proveedor remoto se deben completar URL, key y model y cambiar `CHATBOT_PROVIDER=remote`. La clave solo se utiliza del lado del servidor y nunca se renderiza en HTML o JavaScript.

### Contexto permitido

El proveedor remoto recibe únicamente contexto público controlado del locale activo: nombre, tipo, resumen, stack, señal, capacidades y URL pública del case study. La disponibilidad de WhatsApp/correo se comunica solo como sí/no.

No se envían repositorios, código fuente, secretos, variables de entorno, información de Jira/GitHub interno ni credenciales. El mensaje del visitante se valida y tiene un máximo de 500 caracteres.

### Calificación de prospectos

Cuando el visitante expresa intención de cotizar, contratar o construir una solución, el backend marca la respuesta con `lead_intent`. El navegador inicia una calificación breve con problema, tipo de solución, usuarios, plazo y presupuesto opcional.

Todas las preguntas, el resumen y los enlaces precompuestos de contacto se generan en el idioma activo. La calificación se conserva únicamente en memoria mientras la página está abierta; no se guarda en base de datos, `localStorage` ni `sessionStorage`.

Si existe `PORTFOLIO_WHATSAPP`, se crea un enlace `wa.me` con el resumen precompuesto. Si existe `PORTFOLIO_EMAIL`, se crea un `mailto:` con asunto y cuerpo precompuestos. El visitante decide si abre el canal; el sitio no envía nada automáticamente.

## Publicación y SEO técnico

- `/robots.txt` bloquea indexación fuera de producción y habilita sitemap en producción.
- `/sitemap.xml` incluye home y case studies en español e inglés.
- El layout centraliza title, description, canonical, Open Graph, Twitter Card, `og:locale` y `hreflang`.
- `public/favicon.svg` contiene el brand mark `>_` del portafolio.

## Roadmap

`TODO.md` es la referencia canónica del tramo restante hacia lanzamiento. Jira continúa siendo la fuente de verdad para IDs y estados de ejecución.

## Flujo de trabajo

Jira project key: `AL`.

Cada cambio funcional se desarrolla en una rama asociada a su ticket de Jira y se integra mediante pull request.

## Dirección visual

El sitio combina una interfaz editorial/premium con pequeños recursos inspirados en terminal. La consola funciona como lenguaje visual, no como interfaz completa.
