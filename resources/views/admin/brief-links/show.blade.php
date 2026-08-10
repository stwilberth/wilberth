<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ver Enlace Brief - Admin Wilberth</title>
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

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">{{ $briefLink->name ?? 'Sin nombre' }}</h2>
                    <p class="text-sm text-slate-500 mt-1">Token: <code class="bg-slate-100 px-2 py-1 rounded text-xs">{{ $briefLink->token }}</code></p>
                </div>
                <div class="flex items-center gap-3">
                    @if ($briefLink->is_active)
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Activo</span>
                    @else
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">Inactivo</span>
                    @endif
                    <form method="POST" action="/admin/brief-links/{{ $briefLink->id }}/toggle" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-amber-600 hover:text-amber-800 font-medium">
                            {{ $briefLink->is_active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="bg-slate-50 rounded-xl p-4">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">URL del formulario</label>
                    <div class="flex items-center gap-2">
                        <input type="text" readonly value="{{ url('/brief/' . $briefLink->token) }}"
                            class="flex-1 text-sm font-mono bg-white border border-slate-200 rounded px-3 py-2 text-slate-700"
                            onclick="this.select()">
                        <button onclick="copyToClipboard(this)" data-url="{{ url('/brief/' . $briefLink->token) }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                            Copiar
                        </button>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Creado</label>
                        <p class="text-sm text-slate-900">{{ $briefLink->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Expira</label>
                        <p class="text-sm text-slate-900">{{ $briefLink->expires_at ? $briefLink->expires_at->format('d/m/Y') : 'Nunca' }}</p>
                    </div>
                </div>

                @if ($briefLink->brief)
                    <div class="border-t border-slate-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-slate-900">Brief Completado</h3>
                            <a href="/admin/brief/{{ $briefLink->brief->id }}/download"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-4 py-2 rounded-lg transition-colors inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Descargar Markdown
                            </a>
                        </div>

                        <div class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Negocio</label>
                                    <p class="text-sm font-medium text-slate-900">{{ $briefLink->brief->business_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $briefLink->brief->business_type }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Contacto</label>
                                    <p class="text-sm text-slate-900">{{ $briefLink->brief->contact_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $briefLink->brief->email }} · {{ $briefLink->brief->phone }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Descripción</label>
                                <p class="text-sm text-slate-700">{{ $briefLink->brief->business_description }}</p>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Presupuesto</label>
                                    <p class="text-sm text-slate-900">{{ $briefLink->brief->budget ?? 'No especificado' }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Plazo</label>
                                    <p class="text-sm text-slate-900">{{ $briefLink->brief->timeline ?? 'No especificado' }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Páginas solicitadas</label>
                                <p class="text-sm text-slate-700">{{ implode(', ', $briefLink->brief->pages_needed) }}</p>
                            </div>

                            @if ($briefLink->brief->extra_features)
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Funcionalidades extra</label>
                                    <p class="text-sm text-slate-700">{{ $briefLink->brief->extra_features }}</p>
                                </div>
                            @endif

                            @if ($briefLink->brief->brand_colors)
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Colores</label>
                                    <p class="text-sm text-slate-700">{{ $briefLink->brief->brand_colors }}</p>
                                </div>
                            @endif

                            @if ($briefLink->brief->website_examples)
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Ejemplos de sitios</label>
                                    <p class="text-sm text-slate-700">{{ $briefLink->brief->website_examples }}</p>
                                </div>
                            @endif

                            @if ($briefLink->brief->competitors)
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Competidores</label>
                                    <p class="text-sm text-slate-700">{{ $briefLink->brief->competitors }}</p>
                                </div>
                            @endif

                            @if ($briefLink->brief->special_notes)
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Notas especiales</label>
                                    <p class="text-sm text-slate-700">{{ $briefLink->brief->special_notes }}</p>
                                </div>
                            @endif

                            <div class="text-xs text-slate-400 pt-4 border-t border-slate-100">
                                Completado el: {{ $briefLink->brief->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <p class="text-sm text-amber-800">El cliente aún no ha completado el brief.</p>
                        </div>
                    </div>
                @endif
            </div>
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
