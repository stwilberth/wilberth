<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Factura {{ $invoice->invoice_number }} - Wilberth</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1e293b; padding: 40px; }
        table { border-collapse: collapse; }
        .client-info { border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 16px 0; margin-bottom: 32px; display: flex; justify-content: space-between; }
        .client-info strong { font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; }
        .client-info p { margin: 4px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 32px; }
        th { text-align: left; padding: 8px 12px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 2px solid #e2e8f0; }
        td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-mono { font-family: 'DejaVu Sans Mono', monospace; }
        .totals { width: 280px; margin-left: auto; }
        .totals > div { display: flex; justify-content: space-between; padding: 4px 0; font-size: 12px; color: #64748b; }
        .totals .grand { font-size: 16px; font-weight: 900; color: #0f172a; border-top: 2px solid #e2e8f0; padding-top: 8px; margin-top: 4px; }
        .notes { margin-top: 32px; padding: 16px; background: #f8fafc; border-radius: 8px; font-size: 11px; }
        .footer { margin-top: 40px; padding-top: 16px; border-top: 1px solid #e2e8f0; text-align: center; font-size: 10px; color: #94a3b8; }
    </style>
</head>
<body>
    <table style="width:100%; margin-bottom:24px;">
        <tr>
            <td style="text-align:left; vertical-align:middle;">
                <img src="{{ public_path('assets/images/logo_wilberth.png') }}" alt="Wilberth" style="height:48px; width:auto;" />
            </td>
            <td style="text-align:left; vertical-align:middle; padding-left:16px;">
                <p style="margin:0; font-size:16px; font-weight:900; color:#0f172a;">wilberth.com</p>
                <p style="margin:2px 0 0; font-size:12px; color:#64748b;">Desarrollo Web</p>
                <p style="margin:2px 0 0; font-size:12px; color:#64748b;">+506 85008393</p>
            </td>
            <td style="text-align:right; vertical-align:middle;">
                <h1 style="font-size:24px; font-weight:900; margin:0 0 4px; color:#0f172a;">Factura</h1>
                <p style="color:#64748b; font-size:12px; margin:0;">{{ $invoice->invoice_number }}</p>
                <p style="color:#64748b; font-size:12px; margin:0;">{{ $invoice->created_at->format('d/m/Y') }}</p>
            </td>
        </tr>
    </table>

    @if ($invoice->haciendaDocument)
        @php
            $emisor = $invoice->haciendaDocument->emisor_data;
            $respEstado = $invoice->haciendaDocument->respuesta_estado;
        @endphp
        <table style="width:100%; background:#f8fafc; border-radius:8px; margin-bottom:24px;">
            <tr>
                <td style="padding:16px;">
                    @if ($respEstado)
                        <p style="margin:0 0 4px; font-size:10px; text-transform:uppercase; letter-spacing:0.05em; color:#64748b;"><strong>Estado Hacienda:</strong> <span style="font-weight:900; color:{{ $respEstado === 'Aceptado' ? '#047857' : ($respEstado === 'Rechazado' ? '#b91c1c' : '#b45309') }};">{{ $respEstado }}</span></p>
                    @endif
                    <p style="margin:0 0 4px; font-size:10px; text-transform:uppercase; letter-spacing:0.05em; color:#64748b;"><strong>Emisor</strong></p>
                    <p style="margin:0; font-size:12px; font-weight:700; color:#1e293b;">{{ $emisor['name'] ?? $invoice->haciendaDocument->emisor }}</p>
                    @if (! empty($emisor['id_number']))
                        <p style="margin:2px 0 0; font-size:10px; color:#64748b;">{{ strtoupper($emisor['id_type'] ?? '') }}: {{ $emisor['id_number'] }}</p>
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
                        <p style="margin:2px 0 0; font-size:10px; color:#64748b;">{{ $emisorUbi }}</p>
                    @endif
                    <p style="margin:6px 0 0; font-family:'DejaVu Sans Mono',monospace; font-size:11px;">Consecutivo: {{ $invoice->haciendaDocument->numero_consecutivo }}</p>
                    <p style="margin:2px 0 0; font-family:'DejaVu Sans Mono',monospace; font-size:9px; word-break:break-all;">Clave: {{ $invoice->haciendaDocument->clave }}</p>
                </td>
            </tr>
        </table>
    @endif

    <div class="client-info">
        <div>
            <strong>Cliente</strong>
            <p>{{ $invoice->client_name }}</p>
            <p>{{ strtoupper($invoice->client_id_type) }}: {{ $invoice->client_id_number }}</p>
            <p>{{ $invoice->client_address ?? '' }}</p>
            <p>{{ $invoice->client_email }}</p>
            <p>{{ $invoice->client_phone }}</p>
        </div>
        <div style="text-align:right;">
            <strong>Estado</strong>
            <p>{{ ucfirst($invoice->status) }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th class="text-center">Cantidad</th>
                <th class="text-right">P. Unitario</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right font-mono">&#8353;{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right font-mono">&#8353;{{ number_format($item->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div><span>Subtotal</span><span class="font-mono">&#8353;{{ number_format($invoice->subtotal, 0, ',', '.') }}</span></div>
        <div><span>IVA ({{ $invoice->tax_rate }}%)</span><span class="font-mono">&#8353;{{ number_format($invoice->tax_amount, 0, ',', '.') }}</span></div>
        <div class="grand"><span>Total</span><span class="font-mono">&#8353;{{ number_format($invoice->total, 0, ',', '.') }}</span></div>
    </div>

    @if ($invoice->notes)
        <div class="notes">
            <strong style="font-size:10px;text-transform:uppercase;letter-spacing:0.05em;color:#64748b;">Notas</strong>
            <p style="margin:4px 0 0;">{{ $invoice->notes }}</p>
        </div>
    @endif

    <div class="footer">
        <p>Wilberth - Desarrollo Web para Emprendedores | WhatsApp: +506 85008393</p>
    </div>
</body>
</html>
