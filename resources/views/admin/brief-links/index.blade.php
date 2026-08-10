<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Brief Links - Admin Wilberth</title>
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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-6">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900">Enlaces de Brief</h2>
                <a href="/admin/brief-links/create" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-4 py-2 rounded-lg transition-colors">+ Crear Enlace</a>
            </div>

            @if ($links->isEmpty())
                <div class="p-12 text-center text-slate-400">
                    <p class="text-lg">No hay enlaces creados aún</p>
                    <a href="/admin/brief-links/create" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm mt-2 inline-block">Crear el primero</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider">
                            <tr>
                                <th class="text-left px-6 py-3 font-medium">Nombre</th>
                                <th class="text-left px-6 py-3 font-medium">Token</th>
                                <th class="text-left px-6 py-3 font-medium">URL</th>
                                <th class="text-center px-6 py-3 font-medium">Brief</th>
                                <th class="text-center px-6 py-3 font-medium">Estado</th>
                                <th class="text-left px-6 py-3 font-medium">Expira</th>
                                <th class="text-center px-6 py-3 font-medium">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($links as $link)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900">{{ $link->name ?? 'Sin nombre' }}</td>
                                    <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ $link->token }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <input type="text" readonly value="{{ url('/brief/' . $link->token) }}"
                                                class="text-xs font-mono bg-slate-50 border border-slate-200 rounded px-2 py-1 w-64 text-slate-600"
                                                onclick="this.select()">
                                            <button onclick="copyToClipboard(this)" data-url="{{ url('/brief/' . $link->token) }}"
                                                class="text-xs bg-slate-100 hover:bg-slate-200 text-slate-600 px-2 py-1 rounded transition-colors">
                                                Copiar
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($link->brief_count > 0)
                                            <span class="inline-flex items-center gap-1 text-emerald-600 text-sm font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Completado
                                            </span>
                                        @else
                                            <span class="text-slate-400 text-sm">Pendiente</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form method="POST" action="/admin/brief-links/{{ $link->id }}/toggle" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $link->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $link->is_active ? 'Activo' : 'Inactivo' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 text-xs">
                                        {{ $link->expires_at ? $link->expires_at->format('d/m/Y') : 'Nunca' }}
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="/admin/brief-links/{{ $link->id }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Ver</a>
                                        <form method="POST" action="/admin/brief-links/{{ $link->id }}" class="inline" onsubmit="return confirm('¿Eliminar este enlace?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>

    <script>
        function copyToClipboard(btn) {
            navigator.clipboard.writeText(btn.dataset.url).then(() => {
                btn.textContent = '¡Copiado!';
                setTimeout(() => btn.textContent = 'Copiar', 1500);
            });
        }
    </script>
</body>
</html>
