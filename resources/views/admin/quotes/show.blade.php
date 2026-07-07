@php
    $badge = match($quote->status) {
        'pendiente' => 'bg-amber-100 text-amber-800',
        'aprobada' => 'bg-emerald-100 text-emerald-800',
        'rechazada' => 'bg-red-100 text-red-800',
        default => 'bg-slate-100 text-slate-800',
    };
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cotización #{{ $quote->id }} - Admin Wilberth</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 min-h-screen">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-black text-slate-900">Cotización #{{ $quote->id }}</h1>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $badge }}">{{ $quote->status }}</span>
            </div>
            <a href="/admin/dashboard" class="text-sm text-slate-500 hover:text-slate-700">← Volver</a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-6">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 mb-1">Cotización #{{ $quote->id }}</h2>
                    <p class="text-sm text-slate-500">Creada el {{ $quote->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 p-6 bg-slate-50 rounded-xl">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Cliente</p>
                    <p class="font-bold text-slate-900">{{ $quote->client_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Email</p>
                    <p class="text-slate-700">{{ $quote->client_email }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Teléfono</p>
                    <p class="text-slate-700">{{ $quote->client_phone }}</p>
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
                    @foreach ($quote->items as $item)
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
                    <span class="font-mono">₡{{ number_format($quote->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-slate-600">
                    <span>IVA ({{ $quote->tax_rate }}%)</span>
                    <span class="font-mono">₡{{ number_format($quote->tax_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold text-slate-900 border-t border-slate-200 pt-2">
                    <span>Total</span>
                    <span class="font-mono">₡{{ number_format($quote->total, 0, ',', '.') }}</span>
                </div>
            </div>

            @if ($quote->notes)
                <div class="mt-6 p-4 bg-slate-50 rounded-xl">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Notas</p>
                    <p class="text-sm text-slate-700 whitespace-pre-wrap">{{ $quote->notes }}</p>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Acciones</h3>
            <div class="flex flex-wrap gap-3">
                <form method="POST" action="/admin/quotes/{{ $quote->id }}/status" class="inline">
                    @csrf
                    <input type="hidden" name="status" value="aprobada" />
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors">Aprobar</button>
                </form>
                <form method="POST" action="/admin/quotes/{{ $quote->id }}/status" class="inline">
                    @csrf
                    <input type="hidden" name="status" value="rechazada" />
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors">Rechazar</button>
                </form>
                <form method="POST" action="/admin/quotes/{{ $quote->id }}/status" class="inline">
                    @csrf
                    <input type="hidden" name="status" value="pendiente" />
                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors">Marcar Pendiente</button>
                </form>
                <form method="POST" action="/admin/quotes/{{ $quote->id }}" class="inline" onsubmit="return confirm('¿Eliminar esta cotización?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-white border border-red-300 text-red-600 hover:bg-red-50 text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">Eliminar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
