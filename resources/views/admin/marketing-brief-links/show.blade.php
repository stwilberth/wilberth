<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ver Enlace Marketing Brief - Admin Wilberth</title>
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
                    <a href="/admin/brief-links" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">Brief Links</a>
                    <a href="/admin/marketing-brief-links" class="px-4 py-2 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg">Marketing Briefs</a>
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
                    <h2 class="text-lg font-bold text-slate-900">{{ $marketingBriefLink->name ?? 'Sin nombre' }}</h2>
                    <p class="text-sm text-slate-500 mt-1">Token: <code class="bg-slate-100 px-2 py-1 rounded text-xs">{{ $marketingBriefLink->token }}</code></p>
                </div>
                <div class="flex items-center gap-3">
                    @if ($marketingBriefLink->is_active)
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Activo</span>
                    @else
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">Inactivo</span>
                    @endif
                    <form method="POST" action="/admin/marketing-brief-links/{{ $marketingBriefLink->id }}/toggle" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-amber-600 hover:text-amber-800 font-medium">
                            {{ $marketingBriefLink->is_active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="bg-slate-50 rounded-xl p-4">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">URL del formulario</label>
                    <div class="flex items-center gap-2">
                        <input type="text" readonly value="{{ url('/marketing-brief/' . $marketingBriefLink->token) }}"
                            class="flex-1 text-sm font-mono bg-white border border-slate-200 rounded px-3 py-2 text-slate-700"
                            onclick="this.select()">
                        <button onclick="copyToClipboard(this)" data-url="{{ url('/marketing-brief/' . $marketingBriefLink->token) }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                            Copiar
                        </button>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Creado</label>
                        <p class="text-sm text-slate-900">{{ $marketingBriefLink->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Expira</label>
                        <p class="text-sm text-slate-900">{{ $marketingBriefLink->expires_at ? $marketingBriefLink->expires_at->format('d/m/Y') : 'Nunca' }}</p>
                    </div>
                </div>

                @if ($marketingBriefLink->marketingBrief)
                    <div class="border-t border-slate-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-slate-900">Marketing Brief Completado</h3>
                            <a href="/admin/marketing-brief/{{ $marketingBriefLink->marketingBrief->id }}/download"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-4 py-2 rounded-lg transition-colors inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Descargar Markdown
                            </a>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Contacto</label>
                                <p class="text-sm text-slate-900 font-medium">{{ $marketingBriefLink->marketingBrief->contact_name }}</p>
                                <p class="text-xs text-slate-500">{{ $marketingBriefLink->marketingBrief->email }} · {{ $marketingBriefLink->marketingBrief->phone }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">¿Qué vendés o qué servicio ofrecés?</label>
                                <p class="text-sm text-slate-700">{{ $marketingBriefLink->marketingBrief->offer }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">¿Qué tipo de personas son tus principales clientes?</label>
                                <p class="text-sm text-slate-700">{{ $marketingBriefLink->marketingBrief->target_audience }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">¿Por qué tus clientes te eligen a ti y no a otro negocio?</label>
                                <p class="text-sm text-slate-700">{{ $marketingBriefLink->marketingBrief->differentiator }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">¿Qué es lo que más te interesa conseguir con la página?</label>
                                <p class="text-sm text-slate-700">{{ $marketingBriefLink->marketingBrief->main_goal }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">¿Qué es lo primero que te gustaría que una persona entendiera al entrar a tu página?</label>
                                <p class="text-sm text-slate-700">{{ $marketingBriefLink->marketingBrief->first_impression }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">¿Hay algún producto o servicio que te interese promocionar especialmente?</label>
                                <p class="text-sm text-slate-700">{{ $marketingBriefLink->marketingBrief->promoted_service }}</p>
                            </div>

                            <div class="text-xs text-slate-400 pt-4 border-t border-slate-100">
                                Completado el: {{ $marketingBriefLink->marketingBrief->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <p class="text-sm text-amber-800">El cliente aún no ha completado el marketing brief.</p>
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
