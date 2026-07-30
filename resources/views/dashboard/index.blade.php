@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-bottom:24px;">
        <div><strong>Total Product:</strong> {{ $totalProducts }}</div>
        <div><strong>Total Category:</strong> {{ $totalCategories }}</div>
        <div><strong>Total User:</strong> {{ $totalUsers }}</div>
        <div><strong>Total Order:</strong> {{ $totalOrders }}</div>
        <div><strong>Total Revenue:</strong> {{ number_format($totalRevenue, 2) }}</div>
        <div><strong>Total Inventory Value:</strong> {{ number_format($totalInventoryValue, 2) }}</div>
    </div>

    <h3>5 Sản phẩm đắt nhất</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Order Items Count</th>
        </tr>
        @foreach ($topExpensiveProducts as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->order_items_count }}</td>
            </tr>
        @endforeach
    </table>

    <h3>5 Sản phẩm bán chạy nhất</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Sold Quantity</th>
            <th>Price</th>
        </tr>
        @foreach ($topSellingProducts as $item)
            <tr>
                <td>{{ $item->product ? $item->product->name : '' }}</td>
                <td>{{ $item->total_sold }}</td>
                <td>{{ number_format($item->product ? $item->product->price : 0, 2) }}</td>
            </tr>
        @endforeach
    </table>

    <h3>5 Sản phẩm tồn kho nhiều nhất</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Stock</th>
            <th>Price</th>
        </tr>
        @foreach ($topStockProducts as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
            </tr>
        @endforeach
    </table>
@endsection
