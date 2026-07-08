<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Cotización {{ $quote->quote_number }} - Wilberth Loría</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1e293b; padding: 40px; }
        .header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 40px; }
        .header-left h1 { font-size: 24px; font-weight: 900; margin: 0 0 4px; color: #0f172a; }
        .header-left p { color: #64748b; font-size: 12px; margin: 0; }
        .header-right { text-align: right; font-size: 12px; color: #0f172a; }
        .header-right p { margin: 2px 0; }
        .client-info { border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 16px 0; margin-bottom: 32px; display: flex; justify-content: space-between; }
        .client-info strong { font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; }
        .client-info p { margin: 4px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 32px; }
        th { text-align: left; padding: 8px 12px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 2px solid #e2e8f0; }
        td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-mono { font-family: 'DejaVu Sans Mono', monospace; }
        .currency { font-family: 'DejaVu Sans', sans-serif; font-weight: normal; }
        .totals { width: 280px; margin-left: auto; border-collapse: collapse; }
        .totals td { padding: 4px 0; font-size: 12px; color: #64748b; }
        .totals td.label { text-align: left; }
        .totals td.amount { text-align: right; }
        .totals tr.grand td { font-size: 16px; font-weight: 900; color: #0f172a; border-top: 2px solid #e2e8f0; padding-top: 8px; }
        .notes { margin-top: 32px; padding: 16px; background: #f8fafc; border-radius: 8px; font-size: 11px; }
        .footer { margin-top: 40px; padding-top: 16px; border-top: 1px solid #e2e8f0; text-align: center; font-size: 10px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <h1>Cotización {{ $quote->quote_number }}</h1>
            <p>{{ $quote->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="header-right">
            <p><strong>Wilberth Loría</strong></p>
            <p>Cédula: 603950512</p>
            <p>Tel: +506 85008393</p>
            <p>Correo: stwilberth@gmail.com</p>
            <p>Dirección: Puerto Jiménez, Puntarenas, Costa Rica</p>
        </div>
    </div>

    <div class="client-info">
        <div>
            <strong>Cliente</strong>
            <p>{{ $quote->client_name }}</p>
            <p>{{ strtoupper($quote->client_id_type) }}: {{ $quote->client_id_number }}</p>
            <p>{{ $quote->client_address ?? '' }}</p>
            <p style="word-break: break-word;">{{ $quote->client_email }}</p>
            <p>{{ $quote->client_phone }}</p>
        </div>
        <div style="text-align:right;">
            <strong>Estado</strong>
            <p>{{ ucfirst($quote->status) }}</p>
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
            @foreach ($quote->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right font-mono"><span class="currency">&#x20A1;</span>{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right font-mono"><span class="currency">&#x20A1;</span>{{ number_format($item->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td class="label">Subtotal</td>
            <td class="amount font-mono"><span class="currency">&#x20A1;</span>{{ number_format($quote->subtotal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">IVA ({{ $quote->tax_rate }}%)</td>
            <td class="amount font-mono"><span class="currency">&#x20A1;</span>{{ number_format($quote->tax_amount, 0, ',', '.') }}</td>
        </tr>
        <tr class="grand">
            <td class="label">Total</td>
            <td class="amount"><span class="currency">&#x20A1;</span>{{ number_format($quote->total, 0, ',', '.') }}</td>
        </tr>
    </table>

    @if ($quote->notes)
        <div class="notes">
            <strong style="font-size:10px;text-transform:uppercase;letter-spacing:0.05em;color:#64748b;">Notas</strong>
            <p style="margin:4px 0 0;">{{ $quote->notes }}</p>
        </div>
    @endif

    <div class="footer">
        <p>Cotización generada por Wilberth.com | WhatsApp: +506 85008393</p>
    </div>
</body>
</html>
