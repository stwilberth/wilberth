@php
    $badge = $invoice->status === 'emitida' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800';
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Factura {{ $invoice->invoice_number }} - Admin Wilberth</title>
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
                    <a href="/admin/invoices" class="px-4 py-2 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg">Facturas</a>
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

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 mb-1">Factura {{ $invoice->invoice_number }}</h2>
                    <p class="text-sm text-slate-500">Creada el {{ $invoice->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            @if ($invoice->haciendaDocument)
                @php $emisor = $invoice->haciendaDocument->emisor_data; @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-4 bg-slate-50 rounded-xl">
                    <div class="space-y-2">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Emisor (del XML)</p>
                        <p class="font-bold text-slate-900">{{ $emisor['name'] ?? $invoice->haciendaDocument->emisor }}</p>
                        @if (! empty($emisor['name_comercial']))
                            <p class="text-sm text-slate-600">Nombre comercial: {{ $emisor['name_comercial'] }}</p>
                        @endif
                        @if (! empty($emisor['id_number']))
                            <p class="text-sm text-slate-600">{{ strtoupper($emisor['id_type'] ?? '') }}: {{ $emisor['id_number'] }}</p>
                        @endif
                        @if (! empty($emisor['email']))
                            <p class="text-sm text-slate-600">{{ $emisor['email'] }}</p>
                        @endif
                        @if (! empty($emisor['phone']))
                            <p class="text-sm text-slate-600">Tel: {{ $emisor['phone'] }}</p>
                        @endif
                        @php
                            $pro = $emisor['province'] ?? null;
                            $can = $emisor['canton'] ?? null;
                            $dis = $emisor['district'] ?? null;
                            $ubicacion = collect([
                                $pro && $can && $dis ? \App\Services\CostaRicaLocations::districtName($pro, $can, $dis) : null,
                                $pro && $can ? \App\Services\CostaRicaLocations::cantonName($pro, $can) : null,
                                $pro ? \App\Services\CostaRicaLocations::provinceName($pro) : null,
                                $emisor['address'] ?? null,
                            ])->filter()->implode(', ');
                        @endphp
                        @if ($ubicacion)
                            <p class="text-sm text-slate-600">{{ $ubicacion }}</p>
                        @endif
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Hacienda</p>
                        @php
                            $respEstado = $invoice->haciendaDocument->respuesta_estado;
                            $respBadge = match ($respEstado) {
                                'Aceptado' => 'bg-emerald-100 text-emerald-800',
                                'Rechazado' => 'bg-red-100 text-red-800',
                                'Parcialmente aceptado' => 'bg-amber-100 text-amber-800',
                                default => null,
                            };
                        @endphp
                        @if ($respEstado)
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Estado Hacienda</p>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $respBadge ?? 'bg-slate-100 text-slate-700' }}">{{ $respEstado }}</span>
                                @if ($invoice->haciendaDocument->respuesta_fecha)
                                    <p class="text-xs text-slate-500 mt-1">{{ $invoice->haciendaDocument->respuesta_fecha }}</p>
                                @endif
                                @foreach ($invoice->haciendaDocument->respuesta_mensajes ?? [] as $msg)
                                    <p class="text-xs text-slate-600 mt-1">{{ $msg['mensaje'] ?? '' }}</p>
                                @endforeach
                            </div>
                        @endif
                        <div>
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Consecutivo</p>
                            <p class="font-mono text-sm text-slate-900">{{ $invoice->haciendaDocument->numero_consecutivo }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Clave</p>
                            <p class="font-mono text-xs text-slate-900 break-all">{{ $invoice->haciendaDocument->clave }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 p-6 bg-slate-50 rounded-xl">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Cliente</p>
                    <p class="font-bold text-slate-900">{{ $invoice->client_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Cédula / ID</p>
                    <p class="text-slate-700 text-sm">{{ strtoupper($invoice->client_id_type) }}: {{ $invoice->client_id_number }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Dirección</p>
                    <p class="text-slate-700 text-sm">{{ $invoice->client_address ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Email</p>
                    <p class="text-slate-700">{{ $invoice->client_email }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Teléfono</p>
                    <p class="text-slate-700">{{ $invoice->client_phone }}</p>
                </div>
            </div>

            <table class="w-full mb-6">
                <thead>
                    <tr class="border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500">
                        <th class="text-left pb-3 font-medium">Descripción</th>
                        <th class="text-center pb-3 font-medium">Cantidad</th>
                        <th class="text-right pb-3 font-medium">P. Unitario</th>
                        <th class="text-right pb-3 font-medium">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($invoice->items as $item)
                        <tr class="text-sm">
                            <td class="py-3 text-slate-900">{{ $item->description }}</td>
                            <td class="py-3 text-center text-slate-600">{{ $item->quantity }}</td>
                            <td class="py-3 text-right font-mono">₡{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td class="py-3 text-right font-mono font-medium">₡{{ number_format($item->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="border-t border-slate-200 pt-4 space-y-2 ml-auto w-72">
                <div class="flex justify-between text-sm text-slate-600">
                    <span>Subtotal</span>
                    <span class="font-mono">₡{{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-slate-600">
                    <span>IVA ({{ $invoice->tax_rate }}%)</span>
                    <span class="font-mono">₡{{ number_format($invoice->tax_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold text-slate-900 border-t border-slate-200 pt-2">
                    <span>Total</span>
                    <span class="font-mono">₡{{ number_format($invoice->total, 0, ',', '.') }}</span>
                </div>
            </div>

            @if ($invoice->notes)
                <div class="mt-6 p-4 bg-slate-50 rounded-xl">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Notas</p>
                    <p class="text-sm text-slate-700 whitespace-pre-wrap">{{ $invoice->notes }}</p>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Acciones</h3>
            <div class="flex flex-wrap gap-3">
                @if ($invoice->haciendaDocument)
                    <a href="/admin/hacienda/{{ $invoice->haciendaDocument->id }}/xml"
                        class="bg-white border border-amber-300 text-amber-600 hover:bg-amber-50 text-sm font-bold px-5 py-2.5 rounded-lg transition-colors flex items-center gap-2">
                        XML Hacienda
                    </a>
                @endif
                <a href="/factura/{{ $invoice->slug }}" target="_blank"
                    class="bg-white border border-indigo-300 text-indigo-600 hover:bg-indigo-50 text-sm font-bold px-5 py-2.5 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                    Compartir
                </a>
                <a href="/factura/{{ $invoice->slug }}/pdf"
                    class="bg-white border border-emerald-300 text-emerald-600 hover:bg-emerald-50 text-sm font-bold px-5 py-2.5 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    PDF
                </a>
                <form method="POST" action="/admin/invoices/{{ $invoice->id }}" class="inline" onsubmit="return confirm('¿Anular esta factura?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-white border border-red-300 text-red-600 hover:bg-red-50 text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">Eliminar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
