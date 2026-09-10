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

La aplicación usa SQLite por defecto para desarrollo. El sitio inicial no requiere persistencia para mostrar el portafolio.

## Contenido del portafolio

Los proyectos destacados se definen en `config/portfolio.php` y se renderizan en la home desde una estructura reutilizable. Esa misma fuente de datos alimenta las páginas individuales de case study en `/proyectos/{slug}`, evitando duplicar contenido o markup por proyecto.

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

Los case studies incluyen un bloque visual reusable. Mientras un proyecto no tenga capturas reales, la vista muestra un `Product snapshot` editorial construido únicamente con datos reales del proyecto: nombre, estado, señal, stack y capacidades. No se generan ni simulan interfaces inexistentes.

Cuando existan capturas reales se pueden añadir directamente al proyecto mediante la clave opcional `media`:

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

El chatbot acepta opciones rápidas y texto libre. La conversación libre usa `POST /chat` y se procesa en Laravel mediante `App\Services\PortfolioChatService`.

Las opciones rápidas funcionan como atajos de bienvenida. En cuanto el visitante envía un mensaje o elige una de ellas, se colapsan automáticamente para liberar espacio y priorizar la conversación. Después queda disponible un control compacto `Opciones` para volver a mostrarlas cuando sea necesario.

La arquitectura tiene dos modos:

1. `local` — motor determinista incluido en el proyecto. No necesita claves ni servicios externos.
2. `remote` — proveedor compatible con un payload de conversación basado en `model` + `messages`. Si el proveedor falla, tarda demasiado o devuelve una respuesta inválida, el servicio vuelve automáticamente al motor local.

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

El proveedor remoto recibe únicamente un contexto público controlado derivado de `config/portfolio.php`: nombre, tipo, resumen, stack, señal, capacidades y URL pública del case study. La disponibilidad de WhatsApp/correo se comunica solo como sí/no.

No se envían repositorios, código fuente, secretos, variables de entorno, información de Jira/GitHub interno ni credenciales. El mensaje del visitante se valida y tiene un máximo de 500 caracteres.

El navegador conserva un fallback mínimo basado en el mismo índice público para que la experiencia no quede inutilizable si el endpoint no está disponible.

### Calificación de prospectos

Cuando el visitante expresa intención de cotizar, contratar o construir una solución, el backend marca la respuesta con `lead_intent`. El navegador puede iniciar entonces una calificación breve con cinco datos de negocio:

- problema o proceso a resolver;
- tipo de solución imaginada;
- personas que la usarían;
- plazo aproximado;
- presupuesto opcional.

La calificación se conserva únicamente en memoria mientras la página está abierta. No se guarda en base de datos, `localStorage` ni `sessionStorage`.

Al finalizar se genera un resumen legible. Si existe `PORTFOLIO_WHATSAPP`, se crea un enlace `wa.me` con el resumen precompuesto. Si existe `PORTFOLIO_EMAIL`, se crea un `mailto:` con asunto y cuerpo precompuestos. El visitante decide si abre alguno de esos canales; el sitio no envía el resumen automáticamente.

El flujo no solicita credenciales ni datos sensibles y mantiene las mismas restricciones de privacidad del chatbot: no expone código, repositorios, Jira ni GitHub interno.

## Publicación y SEO técnico

- `/robots.txt` bloquea indexación fuera de producción y habilita sitemap en producción.
- `/sitemap.xml` incluye la home y los case studies destacados.
- El layout centraliza title, description, canonical, Open Graph y Twitter Card.
- `public/favicon.svg` contiene el brand mark `>_` del portafolio.

## Flujo de trabajo

Jira project key: `AL`.

Cada cambio funcional se desarrolla en una rama asociada a su ticket de Jira y se integra mediante pull request.

## Dirección visual

El sitio combina una interfaz editorial/premium con pequeños recursos inspirados en terminal. La consola funciona como lenguaje visual, no como interfaz completa.
