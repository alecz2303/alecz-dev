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

La vista reusable de case study vive en `resources/views/projects/show.blade.php`. Los slugs desconocidos responden 404 y los proyectos válidos incluyen navegación de regreso al portafolio y entre case studies.

## Contacto y privacidad

El portafolio no publica repositorios ni enlaces al código fuente como llamada a la acción. Los canales directos se configuran por entorno:

```env
PORTFOLIO_WHATSAPP=
PORTFOLIO_EMAIL=
```

Solo se renderizan cuando existe un valor configurado. El asistente del portafolio funciona sin servicios externos y guía a visitantes hacia proyectos, capacidades y contacto. Su arquitectura puede evolucionar después hacia una integración de IA sin hacer depender el lanzamiento inicial de una API externa.

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
