@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Detail Order</h1>

    <div class="card">
        <div class="card-header">
            <h5>Order ID: {{ $order->id }}</h5>
        </div>
        <div class="card-body">
            <p><strong>User:</strong> {{ $order->user->username }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Total:</strong> {{ number_format($order->total, 2) }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <h3 class="mt-4">Order Items</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}
                        @if($item->product->is_premium)
                        <span style="color:gold; font-weight:bold;">(Premium)</span>
                    @endif
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
