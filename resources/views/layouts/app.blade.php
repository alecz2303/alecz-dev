<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portafolio profesional de Alejandro Fedle Rueda Jiménez, AKA Alecz.">
    <title>@yield('title', 'Alecz · Software Developer & Product Builder')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>
