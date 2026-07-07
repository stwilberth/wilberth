<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Factura {{ $invoice->invoice_number }} - Wilberth</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print { .no-print { display: none !important; } body { background: white !important; } }
    </style>
</head>
<body class="bg-slate-100">
    <div class="no-print bg-indigo-600 text-white text-center py-3 text-sm font-medium">
        Factura electrónica
        <a href="/factura/{{ $invoice->id }}/pdf" class="ml-3 underline">Descargar PDF</a>
        <button onclick="window.print()" class="ml-3 underline">Imprimir</button>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <img src="/assets/images/logo_wilberth.png" alt="Wilberth" class="h-14 w-auto mb-4" />
                    <h1 class="text-3xl font-black text-slate-900">Factura</h1>
                    <p class="text-slate-500 text-sm mt-1">{{ $invoice->invoice_number }}</p>
                    <p class="text-slate-500 text-sm">{{ $invoice->created_at->format('d/m/Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-slate-900">Wilberth</p>
                    <p class="text-sm text-slate-500">Desarrollo Web</p>
                    <p class="text-sm text-slate-500">+506 85008393</p>
                </div>
            </div>

            <div class="border-t border-b border-slate-200 py-6 mb-8 grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Cliente</p>
                    <p class="font-bold text-slate-900">{{ $invoice->client_name }}</p>
                    <p class="text-sm text-slate-600">{{ strtoupper($invoice->client_id_type) }}: {{ $invoice->client_id_number }}</p>
                    <p class="text-sm text-slate-600">{{ $invoice->client_email }}</p>
                    <p class="text-sm text-slate-600">{{ $invoice->client_phone }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Estado</p>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $invoice->status === 'emitida' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">{{ ucfirst($invoice->status) }}</span>
                </div>
            </div>

            <table class="w-full mb-8">
                <thead>
                    <tr class="border-b-2 border-slate-200 text-xs uppercase tracking-wider text-slate-500">
                        <th class="text-left pb-3 font-medium">Descripción</th>
                        <th class="text-center pb-3 font-medium w-20">Cantidad</th>
                        <th class="text-right pb-3 font-medium w-32">P. Unitario</th>
                        <th class="text-right pb-3 font-medium w-32">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($invoice->items as $item)
                        <tr class="text-sm">
                            <td class="py-4 text-slate-900">{{ $item->description }}</td>
                            <td class="py-4 text-center text-slate-600">{{ $item->quantity }}</td>
                            <td class="py-4 text-right font-mono">₡{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td class="py-4 text-right font-mono font-medium">₡{{ number_format($item->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="ml-auto w-72 space-y-2">
                <div class="flex justify-between text-sm text-slate-600">
                    <span>Subtotal</span>
                    <span class="font-mono">₡{{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-slate-600">
                    <span>IVA ({{ $invoice->tax_rate }}%)</span>
                    <span class="font-mono">₡{{ number_format($invoice->tax_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold text-slate-900 border-t-2 border-slate-200 pt-2">
                    <span>Total</span>
                    <span class="font-mono">₡{{ number_format($invoice->total, 0, ',', '.') }}</span>
                </div>
            </div>

            @if ($invoice->notes)
                <div class="mt-8 p-4 bg-slate-50 rounded-xl">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Notas</p>
                    <p class="text-sm text-slate-700 whitespace-pre-wrap">{{ $invoice->notes }}</p>
                </div>
            @endif

            <div class="mt-10 pt-6 border-t border-slate-200 text-center text-xs text-slate-400">
                <p>Wilberth - Desarrollo Web para Emprendedores | WhatsApp: +506 85008393</p>
            </div>
        </div>
    </div>
</body>
</html>
