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
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-black text-slate-900">Factura {{ $invoice->invoice_number }}</h1>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $badge }}">{{ $invoice->status }}</span>
            </div>
            <a href="/admin/invoices" class="text-sm text-slate-500 hover:text-slate-700">← Volver</a>
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
                <a href="/factura/{{ $invoice->id }}" target="_blank"
                    class="bg-white border border-indigo-300 text-indigo-600 hover:bg-indigo-50 text-sm font-bold px-5 py-2.5 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                    Compartir
                </a>
                <a href="/factura/{{ $invoice->id }}/pdf"
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
