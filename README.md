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

La home incluye `~/services`, una capa comercial que explica qué puede construir Alecz sin vender tecnologías aisladas ni publicar paquetes o precios inventados. El contenido vive en `config/services.php` y `config/services_en.php`; cada capacidad conecta con case studies reales.

## Perfil profesional y CV

La home incorpora `~/profile`, una síntesis bilingüe de perfil profesional basada únicamente en experiencia ya demostrada por el portafolio: producto end-to-end, web/mobile/desktop/integraciones y un proceso de ingeniería trazable. El contenido vive en `config/professional_profile.php` y evita empleadores, estudios, certificaciones, fechas, métricas o años de experiencia no validados.

El CV descargable es opcional. Se configura mediante:

```env
PORTFOLIO_CV_PATH=
```

El valor debe ser una ruta relativa dentro de `public/`, por ejemplo `cv/alecz.pdf`. El botón de descarga solo se renderiza cuando la variable está configurada **y el archivo existe realmente**. Mientras no exista un CV público aprobado, el sitio muestra únicamente una nota neutral y no genera enlaces rotos.

## Navegación persistente

El sitio conserva el header original y muestra un **Command Dock** flotante con acceso a `~/projects`, `~/services`, `~/about`, `~/contact` y `↑ root`. En home sigue la sección activa; en case studies los accesos regresan a la sección equivalente del home en el locale activo.

## Contenido y evidencia visual

Los proyectos destacados alimentan también sus case studies. La evidencia visual pública se registra en `config/project_media.php`. Digital Persona SchoolBio cuenta con una captura real segura; Citas CRIT, Baseball App, DocTotal y URPE Gestión Clínica usan previews editoriales `CODE-DERIVED PREVIEW` basados en estructura verificable; AcadControl conserva fallback `NO PUBLIC VISUAL`.

No se presentan previews derivados de código como screenshots de ejecución. No se publican repositorios, código fuente, Jira, GitHub, credenciales ni datos identificables.

## Contacto y privacidad

Los canales directos se configuran por entorno y los valores públicos aprobados para producción son:

```env
PORTFOLIO_WHATSAPP=529611120913
PORTFOLIO_EMAIL=me@alecz.dev
```

El número de WhatsApp se guarda en formato internacional solo con dígitos para generar correctamente `wa.me`. Estos valores pertenecen al entorno de despliegue: `.env.example` permanece vacío y seguro para que ningún despliegue herede datos de contacto accidentalmente.

Solo se renderizan cuando existe un valor configurado. El chatbot acepta opciones rápidas y texto libre, puede calificar prospectos y preparar un resumen. La conversación y calificación no se guardan en base de datos, `localStorage` ni `sessionStorage`.

## Asistente del portafolio

Configuración opcional del proveedor remoto:

```env
CHATBOT_PROVIDER=local
CHATBOT_REMOTE_URL=
CHATBOT_REMOTE_KEY=
CHATBOT_REMOTE_MODEL=
CHATBOT_REMOTE_TIMEOUT=8
```

Las claves permanecen server-side y existe fallback local.

## Publicación y SEO técnico

- `/robots.txt` controla indexación según entorno.
- `/sitemap.xml` incluye home y case studies ES/EN.
- El layout centraliza title, description, canonical, Open Graph, Twitter Card, `og:locale` y `hreflang`.
- Home ES/EN expone datos estructurados Schema.org mediante `WebSite`, `ProfilePage` y `Person`, usando solo información profesional ya pública en el portafolio.
- Los case studies exponen `CreativeWork` con nombre, resumen, stack, URL, idioma y autor sin añadir clientes, métricas o perfiles externos no validados.
- La imagen social oficial vive en `public/media/social/alecz-social-card.png` a 1200×630 y alimenta `og:image`, dimensiones, alt localizado y `twitter:image` con `summary_large_image`.
- La configuración reusable del bloque social/SEO vive en `config/seo.php`.
- `public/favicon.svg` contiene el brand mark `>_`.

Las validaciones específicas dependientes del dominio final —previews reales en redes, canonical, sitemap y hreflang en producción— se realizan durante el bloque de production readiness/QA una vez desplegado el dominio público.

## Roadmap

`TODO.md` es la referencia canónica del tramo restante hacia lanzamiento. Jira continúa siendo la fuente de verdad para IDs y estados de ejecución.

## Flujo de trabajo

Jira project key: `AL`. Cada cambio funcional se desarrolla en una rama asociada a su ticket y se integra mediante pull request.

## Dirección visual

El sitio combina una interfaz editorial/premium con pequeños recursos inspirados en terminal. La consola funciona como lenguaje visual, no como interfaz completa.
