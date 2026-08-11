<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Importar XML Hacienda - Admin Wilberth</title>
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
                    <a href="/admin/hacienda/import" class="px-4 py-2 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg">XML Hacienda</a>
                    <a href="/admin/brief-links" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">Brief Links</a>
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

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-6">{{ session('success') }}</div>
        @endif

        @if (session('import_summary'))
            @php $summary = session('import_summary'); @endphp
            <div class="mb-6 space-y-3">
                @if ($summary['imported'])
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                        <strong>{{ count($summary['imported']) }} factura(s) importada(s):</strong>
                        <ul class="list-disc ml-5 mt-1">
                            @foreach ($summary['imported'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($summary['duplicates'])
                    <div class="bg-amber-50 border border-amber-200 text-amber-700 px-4 py-3 rounded-xl text-sm">
                        <strong>{{ count($summary['duplicates']) }} duplicada(s) omitida(s)</strong> (ya registradas)
                    </div>
                @endif
                @if ($summary['skipped'])
                    <div class="bg-sky-50 border border-sky-200 text-sky-700 px-4 py-3 rounded-xl text-sm">
                        <strong>{{ count($summary['skipped']) }} registrado(s) sin factura</strong>
                        <ul class="list-disc ml-5 mt-1">
                            @foreach ($summary['skipped'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($summary['errors'])
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                        <strong>{{ count($summary['errors']) }} error(es):</strong>
                        <ul class="list-disc ml-5 mt-1">
                            @foreach ($summary['errors'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
            <h2 class="text-lg font-bold text-slate-900 mb-1">Importar XML de Hacienda</h2>
            <p class="text-sm text-slate-500 mb-5">Subí los comprobantes electrónicos (factura, tiquete, exportación). Se registrarán como facturas y se vincularán automáticamente a la cotización del cliente si coincide el email o la cédula.</p>

            <form method="POST" action="/admin/hacienda/import" enctype="multipart/form-data">
                @csrf
                <label class="block text-sm font-medium text-slate-700 mb-1">Archivos XML</label>
                <input type="file" name="xmls[]" multiple accept=".xml" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                @error('xmls')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3 rounded-xl transition-colors">Importar</button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Documentos importados</h3>
            </div>

            @if ($documents->isEmpty())
                <div class="p-12 text-center text-slate-400">
                    <p class="text-lg">Aún no hay documentos importados</p>
                    <p class="text-sm mt-1">Subí los XML descargados de Hacienda</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider">
                            <tr>
                                <th class="text-left px-6 py-3 font-medium">Clave</th>
                                <th class="text-left px-6 py-3 font-medium">Consecutivo</th>
                                <th class="text-left px-6 py-3 font-medium">Cliente</th>
                                <th class="text-right px-6 py-3 font-medium">Total</th>
                                <th class="text-center px-6 py-3 font-medium">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($documents as $doc)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-slate-500 text-xs">{{ \Illuminate\Support\Str::limit($doc->clave, 18) }}</td>
                                    <td class="px-6 py-4 font-mono text-slate-900 text-xs">{{ $doc->numero_consecutivo }}</td>
                                    <td class="px-6 py-4 text-slate-900">{{ $doc->receptor }}</td>
                                    <td class="px-6 py-4 text-right font-mono font-medium">₡{{ number_format($doc->total, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center space-x-3 text-sm">
                                        @if ($doc->invoice)
                                            <a href="/admin/invoices/{{ $doc->invoice->id }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Ver factura</a>
                                        @else
                                            <span class="text-slate-400">Sin factura</span>
                                        @endif
                                        <a href="/admin/hacienda/{{ $doc->id }}/xml" class="text-emerald-600 hover:text-emerald-800 font-medium">XML</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
