# Deploy cPanel — alecz.dev

Este documento describe el despliegue de producción del portafolio en cPanel/WHM sin SSH ni Terminal.

## Infraestructura

- Dominio: `https://alecz.dev`
- Home: `/home/alecz`
- Aplicación privada: `/home/alecz/alecz-app`
- Document root público: `/home/alecz/public_html`
- PHP: 8.4
- SSL: activo
- Método: File Manager + ZIP

## Estructura objetivo

```text
/home/alecz/
├── alecz-app/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── lang/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── artisan
│   ├── composer.json
│   ├── composer.lock
│   └── .env
└── public_html/
    ├── build/
    ├── media/
    ├── favicon.svg
    ├── index.php
    └── .htaccess
```

`public_html` nunca debe contener `.env`, `vendor`, `storage`, `app`, `config`, `routes`, `.git` ni código fuente interno.

## Preparación del paquete fuera del servidor

Como el hosting no tiene SSH/Terminal, el paquete debe llegar con dependencias y frontend ya construidos.

1. Instalar dependencias de producción:
   `composer install --no-dev --optimize-autoloader`
2. Instalar dependencias frontend y compilar:
   `npm ci`
   `npm run build`
3. Verificar que exista `public/build/manifest.json`.
4. Ejecutar pruebas antes de generar el paquete.
5. El ZIP privado debe incluir `vendor/` y excluir `.env`, `.git`, `node_modules/`, `tests/` y archivos locales innecesarios.
6. El ZIP público debe contener únicamente el contenido de `public/`, sustituyendo `index.php` por `deploy/cpanel/public-index.php`.

## Configuración de producción

Usar `deploy/cpanel/.env.production.example` como base y guardarlo como:

`/home/alecz/alecz-app/.env`

Antes de publicar:

- generar un `APP_KEY` real y único;
- mantener `APP_ENV=production`;
- mantener `APP_DEBUG=false`;
- usar `APP_URL=https://alecz.dev`;
- usar `PORTFOLIO_WHATSAPP=529611120913`;
- usar `PORTFOLIO_EMAIL=me@alecz.dev`;
- mantener `CHATBOT_PROVIDER=local` para el primer lanzamiento.

Nunca subir el `.env` real al repositorio ni colocarlo en `public_html`.

## Subida con File Manager

1. En `/home/alecz`, crear `alecz-app`.
2. Subir y extraer el ZIP privado dentro de `alecz-app`.
3. Abrir `/home/alecz/public_html` y retirar el contenido temporal del hosting conservando cualquier archivo que cPanel requiera explícitamente.
4. Subir y extraer el ZIP público dentro de `public_html`.
5. Confirmar que `public_html/index.php` usa `dirname(__DIR__).'/alecz-app'`.
6. Crear `/home/alecz/alecz-app/.env` a partir del ejemplo de producción.
7. Asegurar escritura para el usuario de la cuenta en:
   - `/home/alecz/alecz-app/storage`
   - `/home/alecz/alecz-app/bootstrap/cache`
   Normalmente `755` para directorios es suficiente; usar `775` solo si el servidor lo requiere. No usar `777`.

## Cachés sin Terminal

No se deben transportar cachés generadas en otra máquina con rutas absolutas distintas. Antes de empaquetar, dejar vacíos los artefactos generados en `bootstrap/cache` salvo `.gitignore` y evitar incluir cachés de runtime de `storage/framework`.

El primer request puede funcionar sin `config:cache`, `route:cache` ni `view:cache`. La prioridad en este hosting es un deploy portable y correcto. Si posteriormente cPanel habilita una interfaz segura para ejecutar Artisan, se podrán activar esas optimizaciones en el servidor.

## Smoke test

Después de subir:

1. Abrir `https://alecz.dev` y comprobar HTTP 200.
2. Abrir `https://alecz.dev/en`.
3. Abrir al menos un case study ES y EN.
4. Probar el chatbot y el handoff a WhatsApp.
5. Probar `mailto:me@alecz.dev`.
6. Verificar `/robots.txt` y `/sitemap.xml`.
7. Confirmar canonical, `hreflang`, Open Graph y la imagen social con URLs de producción.
8. Confirmar que una URL inexistente devuelve 404 controlado.
9. Confirmar que `/.env`, `/vendor/`, `/storage/` y `/app/` no son accesibles públicamente.
10. Revisar responsive en móvil, tablet y desktop.

## Actualizaciones futuras

Las actualizaciones deben construirse nuevamente fuera del servidor y subirse como paquetes nuevos. Nunca sobrescribir el `.env` de producción durante una actualización. Para reducir riesgo, conservar una copia del paquete anterior hasta terminar el smoke test del nuevo despliegue.
