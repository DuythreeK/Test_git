<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
            borderRadius: 8px;
        }

        .header {
            background-color: #4f46e5;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-radius: 6px 6px 0 0;
        }

        .details {
            margin: 20px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f8fafc;
        }

        .total {
            font-weight: bold;
            color: #e11d48;
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Cảm ơn bạn đã đặt hàng!</h2>
        </div>

        <p>Xin chào <strong>{{ $order->receiver_name }}</strong>,</p>
        <p>
            @if ($order->payment_method === 'vnpay' && $order->payment_status === 'paid')
                Đơn hàng <strong>#{{ $order->id }}</strong> của bạn đã được <strong>thanh toán thành công qua
                    VNPay</strong> và đang được xử lý.
            @else
                Đơn hàng <strong>#{{ $order->id }}</strong> của bạn đã được tạo thành công (Thanh toán khi nhận hàng
                - COD) và đang được chuẩn bị.
            @endif
        </p>

        <div class="details">
            <h3>Thông tin đơn hàng #{{ $order->id }}</h3>
            <p><strong>Người nhận:</strong> {{ $order->receiver_name }} - {{ $order->phone }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Hình thức thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p><strong>Trạng thái thanh toán:</strong>
                {{ $order->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}</p>
            @if ($order->note)
                <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
            @endif
        </div>

        <h3>Chi tiết sản phẩm</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->variant->product->name ?? 'Sản phẩm' }}</td>
                        <td>{{ $item->variant->size->name ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price) }}đ</td>
                        <td>{{ number_format($item->subtotal) }}đ</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="total">Tổng cộng:</td>
                    <td class="total">{{ number_format($order->total_price) }}đ</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email hỗ trợ.</p>
        </div>
    </div>
</body>

</html>
