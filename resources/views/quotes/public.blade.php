<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cotización - Wilberth</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
        }
    </style>
</head>
<body class="bg-slate-100">
    <div class="no-print bg-indigo-600 text-white text-center py-3 text-sm font-medium">
        Cotización compartida
        <a href="/cotizacion/{{ $quote->id }}/pdf" class="ml-3 underline">Descargar PDF</a>
        <button onclick="window.print()" class="ml-3 underline">Imprimir</button>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white shadow-lg p-8 md:p-12">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Cotización</h1>
                    <p class="text-slate-500 text-sm mt-1">{{ $quote->created_at->format('d/m/Y') }}</p>
                </div>
                <div class="text-right text-sm text-slate-400">
                    Ref: {{ $quote->quote_number }}
                </div>
            </div>

            <div class="mb-8 space-y-1 text-sm text-slate-700">
                <p class="font-semibold">Wilberth Loría</p>
                <p>Puerto Jiménez, Puntarenas, Costa Rica</p>
                <p>stwilberth@gmail.com</p>
                <p>+506 85008393</p>
                <p>wilberth.com</p>
            </div>

            <div class="border-t border-b border-slate-300 py-5 mb-8 grid grid-cols-2 gap-4 text-sm">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Cliente</p>
                    <p class="font-semibold text-slate-800">{{ $quote->client_name }}</p>
                    <p class="text-slate-600">{{ strtoupper($quote->client_id_type) }}: {{ $quote->client_id_number }}</p>
                    <p class="text-slate-600">{{ $quote->client_address ?? '' }}</p>
                    <p class="text-slate-600">{{ $quote->client_email }}</p>
                    <p class="text-slate-600">{{ $quote->client_phone }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Estado</p>
                    <p class="font-semibold text-amber-600">Pendiente</p>
                </div>
            </div>

            <table class="w-full mb-8 text-sm">
                <thead>
                    <tr class="border-b border-slate-300 text-xs uppercase text-slate-500">
                        <th class="text-left pb-2 font-semibold">Descripción</th>
                        <th class="text-center pb-2 font-semibold">Cantidad</th>
                        <th class="text-right pb-2 font-semibold">P. Unitario</th>
                        <th class="text-right pb-2 font-semibold">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($quote->items as $item)
                        <tr>
                            <td class="py-3 text-slate-800">{{ $item->description }}</td>
                            <td class="py-3 text-center text-slate-600">{{ $item->quantity }}</td>
                            <td class="py-3 text-right font-mono">₡{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td class="py-3 text-right font-mono">₡{{ number_format($item->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="ml-auto w-64 space-y-1 text-sm border-t border-slate-300 pt-3">
                <div class="flex justify-between text-slate-600">
                    <span>Subtotal</span>
                    <span class="font-mono">₡{{ number_format($quote->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>IVA ({{ number_format($quote->tax_rate, 2) }}%)</span>
                    <span class="font-mono">₡{{ number_format($quote->tax_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold text-slate-800 border-t border-slate-300 pt-2 text-base">
                    <span>Total</span>
                    <span class="font-mono">₡{{ number_format($quote->total, 0, ',', '.') }}</span>
                </div>
            </div>

            @if ($quote->notes)
                <div class="mt-8">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Notas</p>
                    <p class="text-sm text-slate-600 whitespace-pre-wrap">{{ $quote->notes }}</p>
                </div>
            @endif

            <div class="mt-10 pt-4 border-t border-slate-200 text-center text-xs text-slate-400">
                <p>Cotización generada por Wilberth.com | WhatsApp: +506 85008393</p>
            </div>
        </div>
    </div>
</body>
</html>
