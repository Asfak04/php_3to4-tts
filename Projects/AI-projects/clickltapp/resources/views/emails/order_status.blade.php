<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f9fafb; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h1 { color: #111827; font-size: 24px; margin-bottom: 20px; text-align: center; }
        p { color: #4b5563; line-height: 1.6; font-size: 16px; margin-bottom: 20px; }
        .box { background-color: #f3f4f6; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .item-list { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .item-list th { text-align: left; padding: 10px; border-bottom: 2px solid #e5e7eb; color: #374151; }
        .item-list td { padding: 10px; border-bottom: 1px solid #e5e7eb; color: #4b5563; }
        .total-row { font-weight: bold; color: #111827; }
        .btn { display: inline-block; background-color: #10b981; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: bold; margin-top: 20px; }
        .footer { text-align: center; margin-top: 40px; color: #9ca3af; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $title }}</h1>
        <p>Hi {{ $order->user->name }},</p>
        <p>{{ $message_text }}</p>

        <div class="box">
            <strong>Order Details:</strong>
            <p style="margin: 5px 0;">Order ID: #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
            <p style="margin: 5px 0;">Date: {{ $order->created_at->format('M d, Y') }}</p>
            <p style="margin: 5px 0;">Delivery Address: {{ $order->address }}</p>
            
            <table class="item-list">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product ? $item->product->name : 'Product Removed' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="2" style="text-align: right;">Total Amount:</td>
                        <td>₹{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('orders') }}" class="btn">View All Orders</a>
        </div>

        <div class="footer">
            <p>Thank you for choosing ClickIT!<br>This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html>
