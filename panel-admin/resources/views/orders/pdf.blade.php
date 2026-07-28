<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>{{ $tipo === 'factura' ? 'Factura' : 'Boleta' }} #{{ $order->id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1C1F26; margin: 0; padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #2D4A3E; padding-bottom: 16px; margin-bottom: 20px; }
        .brand { font-size: 22px; font-weight: bold; color: #2D4A3E; }
        .doc-box { border: 1px solid #2D4A3E; border-radius: 6px; padding: 10px 16px; text-align: center; min-width: 180px; }
        .doc-box .tipo { font-size: 13px; font-weight: bold; color: #2D4A3E; text-transform: uppercase; }
        .doc-box .numero { font-size: 14px; margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #F7F5F1; text-align: left; padding: 8px; font-size: 11px; text-transform: uppercase; color: #555; border-bottom: 1px solid #ddd; }
        td { padding: 8px; border-bottom: 1px solid #eee; }
        .total-row td { font-weight: bold; font-size: 14px; border-top: 2px solid #2D4A3E; border-bottom: none; }
        .section-title { font-size: 11px; text-transform: uppercase; color: #888; margin-bottom: 4px; margin-top: 20px; }
        .muted { color: #777; }
        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #999; }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <div class="brand">Mercato</div>
            <p class="muted" style="margin: 4px 0 0;">Mercato E.I.R.L.<br>RUC: 20123456789<br>Lima, Perú</p>
        </div>
        <div class="doc-box">
            <div class="tipo">{{ $tipo === 'factura' ? 'Factura Electrónica' : 'Boleta de Venta Electrónica' }}</div>
            <div class="numero">{{ $tipo === 'factura' ? 'F001' : 'B001' }}-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>
    </div>

    <div style="display:flex; justify-content: space-between;">
        <div>
            <p class="section-title">Cliente</p>
            <p><strong>{{ $order->user->name }}</strong><br>{{ $order->user->email }}</p>
        </div>
        <div>
            <p class="section-title">Fecha de emisión</p>
            <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <p class="section-title">Dirección de envío</p>
    <p>{{ $order->shipping_address }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th style="text-align:center;">Cantidad</th>
                <th style="text-align:right;">Precio unit.</th>
                <th style="text-align:right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td style="text-align:center;">{{ $item->quantity }}</td>
                    <td style="text-align:right;">S/ {{ number_format($item->price, 2) }}</td>
                    <td style="text-align:right;">S/ {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Total</td>
                <td style="text-align:right;">S/ {{ number_format($order->total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    @if($order->payment)
        <p class="section-title">Datos de pago</p>
        <p>{{ ucfirst($order->payment->method) }} — Ref: {{ $order->payment->reference }}</p>
    @endif

    <div class="footer">
        Documento generado automáticamente por Mercato — Proyecto de portafolio, no válido como comprobante fiscal real.
    </div>
</body>
</html>