<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customizer - Estudio de Diseño</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/customizer.jsx'])
    <style>
        body {
            font-family: 'Outfit', 'Inter', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-slate-950 text-slate-100 h-full overflow-hidden">
    <div id="customizer-root" class="h-full"></div>
</body>
</html>
