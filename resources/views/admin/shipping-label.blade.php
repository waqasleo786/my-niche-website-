<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label — {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            background: #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            gap: 16px;
        }

        .no-print {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-print { background: #1e3a5f; color: #fff; }
        .btn-close { background: #e5e7eb; color: #374151; }

        /* ---- Label Card ---- */
        .label {
            width: 148mm;
            background: #fff;
            border: 2px solid #111;
            padding: 0;
            page-break-inside: avoid;
        }

        /* Header */
        .label-header {
            border-bottom: 2px solid #111;
            padding: 10px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-name {
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 0.5px;
            color: #1e3a5f;
        }

        .brand-sub {
            font-size: 10px;
            color: #555;
            margin-top: 1px;
        }

        .order-number {
            font-size: 11px;
            font-weight: 700;
            text-align: right;
            color: #111;
        }

        .order-date {
            font-size: 10px;
            color: #666;
        }

        /* COD Badge */
        .cod-badge {
            background: #1e3a5f;
            color: #fff;
            text-align: center;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 2px;
            padding: 6px 0;
            border-bottom: 2px solid #111;
        }

        /* From / To grid */
        .address-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-bottom: 2px solid #111;
        }

        .address-box {
            padding: 10px 14px;
        }

        .address-box:first-child {
            border-right: 1px solid #ccc;
        }

        .address-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 4px;
        }

        .address-name {
            font-size: 13px;
            font-weight: 700;
            color: #111;
            margin-bottom: 2px;
        }

        .address-detail {
            font-size: 11px;
            color: #333;
            line-height: 1.5;
        }

        .address-phone {
            font-size: 12px;
            font-weight: 700;
            color: #111;
            margin-top: 4px;
        }

        /* Items */
        .items-section {
            border-bottom: 2px solid #111;
            padding: 8px 14px;
        }

        .items-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 6px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table th {
            font-size: 10px;
            text-transform: uppercase;
            color: #666;
            text-align: left;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }

        .items-table th:last-child,
        .items-table td:last-child {
            text-align: right;
        }

        .items-table th:nth-child(2),
        .items-table td:nth-child(2) {
            text-align: center;
        }

        .items-table td {
            font-size: 11px;
            padding: 4px 0;
            color: #222;
            border-bottom: 1px solid #f0f0f0;
        }

        /* Footer */
        .label-footer {
            padding: 8px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-block .total-label {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
        }

        .total-block .total-amount {
            font-size: 18px;
            font-weight: 900;
            color: #111;
        }

        .barcode-area {
            text-align: right;
        }

        .barcode-text {
            font-size: 9px;
            color: #aaa;
            margin-top: 2px;
        }

        /* Print rules */
        @media print {
            body {
                background: #fff;
                padding: 0;
                display: block;
            }

            .no-print { display: none !important; }

            .label {
                width: 100%;
                border: 2px solid #111;
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button class="btn btn-print" onclick="window.print()">Print Label</button>
        <button class="btn btn-close" onclick="window.close()">Close</button>
    </div>

    <div class="label">

        {{-- Header: Brand + Order # --}}
        <div class="label-header">
            <div>
                <div class="brand-name">Shahid Brothers</div>
                <div class="brand-sub">Promotional &amp; Gift Items</div>
            </div>
            <div>
                <div class="order-number">{{ $order->order_number }}</div>
                <div class="order-date">{{ $order->created_at->format('d M Y') }}</div>
            </div>
        </div>

        {{-- COD Badge --}}
        @if($order->payment_method?->value === 'cod')
        <div class="cod-badge">CASH ON DELIVERY</div>
        @endif

        {{-- From / To --}}
        <div class="address-grid">
            <div class="address-box">
                <div class="address-label">From (Sender)</div>
                <div class="address-name">Shahid Brothers</div>
                <div class="address-detail">
                    Lahore, Pakistan<br>
                    0300-0000000
                </div>
            </div>
            <div class="address-box">
                <div class="address-label">To (Receiver)</div>
                <div class="address-name">{{ $order->shipping_name }}</div>
                <div class="address-detail">
                    {{ $order->shipping_address }}<br>
                    @if($order->shipping_area) {{ $order->shipping_area }}, @endif
                    {{ $order->shipping_city }}
                    @if($order->shipping_province), {{ $order->shipping_province }}@endif
                </div>
                <div class="address-phone">{{ $order->shipping_phone }}</div>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="items-section">
            <div class="items-label">Items Ordered</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product?->name ?? 'Product Deleted' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ number_format((float) $item->total_price, 0) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer: Total --}}
        <div class="label-footer">
            <div class="total-block">
                <div class="total-label">Total Amount</div>
                <div class="total-amount">Rs. {{ number_format((float) $order->total, 0) }}</div>
            </div>
            <div class="barcode-area">
                <div style="font-size:11px; font-weight:700; color:#555;">{{ $order->order_number }}</div>
                <div class="barcode-text">shahidbrothers.pk</div>
            </div>
        </div>

    </div>

    <script>
        window.onload = function () { window.print(); };
    </script>
</body>
</html>
