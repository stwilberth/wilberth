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
        <a href="/factura/{{ $invoice->slug }}/pdf" class="ml-3 underline">Descargar PDF</a>
        @if ($invoice->original_pdf)
            <a href="/factura/{{ $invoice->slug }}/pdf-original" class="ml-3 underline">PDF original</a>
        @endif
        <button onclick="window.print()" class="ml-3 underline">Imprimir</button>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <div class="flex flex-wrap justify-between items-start gap-6 mb-8">
                <div class="flex items-center gap-4">
                    <img src="/assets/images/logo_wilberth.png" alt="Wilberth" class="h-16 w-auto" />
                    <div>
                        <a href="https://wilberth.com" class="text-xl font-black text-slate-900">wilberth.com</a>
                        <p class="text-sm text-slate-500">Desarrollo Web</p>
                        <p class="text-sm text-slate-500">+506 85008393</p>
                    </div>
                </div>
                <div class="text-right">
                    <h1 class="text-3xl font-black text-slate-900">Factura</h1>
                    <p class="text-slate-500 text-sm mt-1">{{ $invoice->invoice_number }}</p>
                    <p class="text-slate-500 text-sm">{{ $invoice->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            @if ($invoice->haciendaDocument)
                @php
                    $emisor = $invoice->haciendaDocument->emisor_data;
                    $respEstado = $invoice->haciendaDocument->respuesta_estado;
                    $respBadge = match ($respEstado) {
                        'Aceptado' => 'bg-emerald-100 text-emerald-800',
                        'Rechazado' => 'bg-red-100 text-red-800',
                        'Parcialmente aceptado' => 'bg-amber-100 text-amber-800',
                        default => 'bg-slate-100 text-slate-700',
                    };
                @endphp
                <div class="mb-8 p-4 bg-slate-50 rounded-xl">
                    <div class="space-y-2">
                        @if ($respEstado)
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Estado Hacienda</span>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $respBadge }}">{{ $respEstado }}</span>
                            </div>
                        @endif
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Emisor</p>
                        <p class="text-sm text-slate-600 font-medium">{{ $emisor['name'] ?? $invoice->haciendaDocument->emisor }}</p>
                        @if (! empty($emisor['id_number']))
                            <p class="text-xs text-slate-500">{{ strtoupper($emisor['id_type'] ?? '') }}: {{ $emisor['id_number'] }}</p>
                        @endif
                        @php
                            $pro = $emisor['province'] ?? null;
                            $can = $emisor['canton'] ?? null;
                            $dis = $emisor['district'] ?? null;
                            $emisorUbi = collect([
                                $pro && $can && $dis ? \App\Services\CostaRicaLocations::districtName($pro, $can, $dis) : null,
                                $pro && $can ? \App\Services\CostaRicaLocations::cantonName($pro, $can) : null,
                                $pro ? \App\Services\CostaRicaLocations::provinceName($pro) : null,
                                $emisor['address'] ?? null,
                            ])->filter()->implode(', ');
                        @endphp
                        @if ($emisorUbi)
                            <p class="text-xs text-slate-500 mt-1">{{ $emisorUbi }}</p>
                        @endif
                        <p class="text-slate-500 text-sm mt-1">Consecutivo: <span class="font-mono">{{ $invoice->haciendaDocument->numero_consecutivo }}</span></p>
                        <p class="text-slate-500 text-xs break-all">Clave: <span class="font-mono">{{ $invoice->haciendaDocument->clave }}</span></p>
                    </div>
                </div>
            @endif

            <div class="border-t border-b border-slate-200 py-6 mb-8 grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Cliente</p>
                    <p class="font-bold text-slate-900">{{ $invoice->client_name }}</p>
                    <p class="text-sm text-slate-600">{{ strtoupper($invoice->client_id_type) }}: {{ $invoice->client_id_number }}</p>
                    <p class="text-sm text-slate-600">{{ $invoice->client_address ?? '' }}</p>
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
