<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 13px; color: #334155; line-height: 1.5; margin: 0; padding: 0; }
        .invoice-container { padding: 40px; }
        
        /* Header Section */
        .header-table { width: 100%; border-bottom: 2px solid #059669; padding-bottom: 25px; margin-bottom: 30px; }
        .brand-name { font-size: 32px; font-weight: bold; color: #065f46; margin: 0; }
        .brand-name span { color: #d97706; }
        .invoice-title { font-size: 24px; color: #64748b; text-transform: uppercase; letter-spacing: 2px; }
        
        /* Details Grid */
        .details-table { width: 100%; margin-bottom: 35px; }
        .details-table td { vertical-align: top; width: 50%; }
        .meta-label { font-size: 11px; font-weight: bold; color: #94a3b8; text-transform: uppercase; display: block; margin-bottom: 5px; }
        .meta-value { font-size: 14px; color: #1e293b; display: block; }
        
        .badge { display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-top: 5px; }
        .badge-paid { background: #dcfce7; color: #166534; }
        .badge-pending { background: #fef3c7; color: #92400e; }

        /* Items Table */
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .items-table th { background: #f8fafc; color: #475569; font-weight: bold; text-transform: uppercase; font-size: 11px; padding: 12px 15px; text-align: left; border-bottom: 2px solid #e2e8f0; }
        .items-table td { padding: 12px 15px; border-bottom: 1px solid #f1f5f9; color: #334155; }
        .items-table tr:nth-child(even) { background: #fbfcfd; }
        .item-name { font-weight: bold; color: #1e293b; display: block; }
        .item-sub { font-size: 11px; color: #94a3b8; }

        /* Summary Section */
        .summary-wrapper { width: 100%; }
        .summary-table { float: right; width: 280px; border-collapse: collapse; }
        .summary-table td { padding: 8px 0; font-size: 14px; }
        .summary-label { color: #64748b; text-align: left; }
        .summary-value { color: #1e293b; text-align: right; font-weight: 500; }
        .grand-total-row td { border-top: 2px solid #059669; padding-top: 15px; margin-top: 10px; }
        .grand-total-label { font-size: 16px; font-weight: bold; color: #065f46; }
        .grand-total-value { font-size: 20px; font-weight: bold; color: #065f46; }

        /* Footer & Policy */
        .policy-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 15px; margin-top: 40px; clear: both; }
        .policy-title { font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 8px; display: block; border-bottom: 1px solid #cbd5e0; padding-bottom: 5px; }
        .policy-text { font-size: 11px; color: #64748b; margin: 0; line-height: 1.6; }
        
        .footer { margin-top: 40px; text-align: center; font-size: 11px; color: #94a3b8; border-top: 1px solid #f1f5f9; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td style="width: 60%;">
                    <h1 class="brand-name">Click<span>IT</span></h1>
                    <p style="color: #64748b; margin-top: 5px;">Fresh Groceries Delivered Fast<br>123 Fresh Way, Food City | support@clickit.com</p>
                </td>
                <td style="width: 40%; text-align: right;">
                    <h2 class="invoice-title">Invoice</h2>
                    <span class="meta-label">Order Number</span>
                    <span class="meta-value" style="font-weight: bold;">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <div class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-pending' }}">
                        {{ strtoupper($order->payment_status) }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Details Grid -->
        <table class="details-table">
            <tr>
                <td>
                    <span class="meta-label">Bill To</span>
                    <span class="meta-value" style="font-weight: bold;">{{ $order->user->name }}</span>
                    <span class="meta-value">{{ $order->address }}</span>
                    <span class="meta-value" style="color: #64748b;">{{ $order->user->email }}</span>
                </td>
                <td style="text-align: right;">
                    <span class="meta-label">Order Details</span>
                    <span class="meta-value">Date: {{ $order->created_at->format('M d, Y') }}</span>
                    <span class="meta-value">Payment: {{ strtoupper($order->payment_method) }}</span>
                    @if($order->transaction_id)
                    <span class="meta-value" style="font-size: 11px; color: #64748b;">TXN: {{ $order->transaction_id }}</span>
                    @endif
                </td>
            </tr>
        </table>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Item Description</th>
                    <th style="width: 15%; text-align: center;">Price</th>
                    <th style="width: 15%; text-align: center;">Qty</th>
                    <th style="width: 20%; text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $itemsSubtotal = 0; @endphp
                @foreach($order->items as $item)
                @php $rowTotal = $item->price * $item->quantity; $itemsSubtotal += $rowTotal; @endphp
                <tr>
                    <td>
                        <span class="item-name">{{ $item->product->name }}</span>
                        <span class="item-sub">Unit: {{ $item->product->unit ?? 'Regular' }}</span>
                    </td>
                    <td style="text-align: center;">&#8377;{{ number_format($item->price, 2) }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right; font-weight: bold;">&#8377;{{ number_format($rowTotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div style="overflow: hidden;">
            <table class="summary-table">
                <tr>
                    <td class="summary-label">Items Subtotal:</td>
                    <td class="summary-value">&#8377;{{ number_format($itemsSubtotal, 2) }}</td>
                </tr>
                <tr>
                    <td class="summary-label">Delivery Charge:</td>
                    <td class="summary-value">&#8377;{{ number_format(max(0, $order->total_amount - $itemsSubtotal), 2) }}</td>
                </tr>
                <tr class="grand-total-row">
                    <td class="grand-total-label">Grand Total:</td>
                    <td class="grand-total-value">&#8377;{{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </table>
        </div>

        <!-- Policy Section -->
        <div class="policy-box">
            <span class="policy-title">Return Policy & Information</span>
            <p class="policy-text">
                &bull; Returns accepted within 24 hours of delivery for fresh produce.<br>
                &bull; Please maintain original packaging and invoice for returns.<br>
                &bull; Refunds processed within 5-7 business days to the original payment source.<br>
                &bull; In case of queries, please quote your Order ID: #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for shopping with <strong>ClickIT</strong>!<br>
            Visit us again for fresh groceries delivered to your doorstep.<br>
            <span style="font-size: 9px; color: #cbd5e1; margin-top: 10px; display: block;">Computer-generated document. No signature required.</span></p>
        </div>
    </div>
</body>
</html>

