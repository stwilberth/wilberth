<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear Enlace Brief - Admin Wilberth</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 min-h-screen">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-black text-slate-900">Admin</h1>
                <nav class="hidden md:flex items-center gap-1 ml-4">
                    <a href="/admin/dashboard" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">Cotizaciones</a>
                    <a href="/admin/quotes/create" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">Nueva Cotización</a>
                    <a href="/admin/invoices" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">Facturas</a>
                    <a href="/admin/brief-links" class="px-4 py-2 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg">Brief Links</a>
                </nav>
            </div>
            <div class="flex items-center gap-3">
                <a href="/" class="text-sm text-slate-500 hover:text-slate-700">Ver sitio</a>
                <form method="POST" action="/admin/logout">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-lg font-bold text-slate-900 mb-6">Crear Nuevo Enlace de Brief</h2>

            <form action="/admin/brief-links" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nombre del cliente (opcional)</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                        placeholder="Ejemplo: Cafetería El Buen Sabor">
                    <p class="text-xs text-slate-500 mt-1">Solo para identificar el enlace en el admin</p>
                </div>

                <div>
                    <label for="expires_at" class="block text-sm font-semibold text-slate-700 mb-2">Fecha de expiración (opcional)</label>
                    <input type="date" name="expires_at" id="expires_at"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    <p class="text-xs text-slate-500 mt-1">Dejar vacío para que no expire</p>
                </div>

                <div class="flex gap-3">
                    <a href="/admin/brief-links" class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-6 py-3 rounded-xl transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
                        Crear Enlace
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
