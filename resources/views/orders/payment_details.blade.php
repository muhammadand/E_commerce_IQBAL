@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 600px; font-family: 'Poppins', sans-serif;">
    <div class="bg-white border shadow-sm rounded-4 p-4">

        <h4 class="text-center text-dark mb-3">Detail Pembayaran</h4>
        <p class="text-center text-muted" style="font-size: 12px;">Order ID: #{{ $order->id }}</p>

        <hr class="my-3" style="border-top: 1px dashed #ccc;">

        <div class="row g-4">

            <!-- Status & User Info -->
            <div class="d-flex justify-content-between flex-wrap gap-4">
                <div class="flex-fill" style="min-width: 200px;">
                    <p class="font-weight-bold text-dark mb-2">Status Pembayaran:</p>
                    <span class="d-inline-block p-2 rounded-3" style="
                        background-color: 
                        {{ $order->payment_status == 'paid' ? '#e0f8ec' : ($order->payment_status == 'failed' ? '#fcebea' : '#fff3cd') }};
                        color: #000; font-size: 13px;">
                        {{ strtoupper($order->payment_status) }}
                    </span>
                </div>

                <div class="flex-fill" style="min-width: 250px;">
                    <p class="font-weight-bold text-dark mb-2">Informasi Pengguna:</p>
                    <p class="mb-1"><strong>Nama:</strong> {{ $order->user->username }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p class="mb-1"><strong>Alamat:</strong> {{ $order->address }}</p>
                </div>
            </div>

            <!-- Produk & Pembayaran -->
            <div class="row g-4">
                <!-- Produk Dipesan -->
                <div class="col-12 col-md-6">
                    <p class="fw-bold mb-2">Produk Dipesan:</p>
                    <ul class="ps-3 mb-0">
                        @foreach ($order->orderItems as $item)
                            <li class="mb-2" style="line-height: 1.5;">
                                @if ($item->product)
                                    {{ $item->product->name }} (x{{ $item->quantity }})
                                    @if($item->product->is_premium)
                                        <span class="text-danger">(Premium)</span>
                                    @endif
                                @elseif ($item->bundle)
                                    Bundle: {{ $item->bundle->name }} (x{{ $item->quantity }})
                                @else
                                    <em>Item tidak diketahui</em>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            
                <!-- Riwayat Pembayaran -->
                <div class="col-12 col-md-6">
                    <p class="fw-bold mb-2">Riwayat Pembayaran:</p>
                    <div class="line-height-1.6">
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $order->updated_at->format('d-m-Y H:i') }}</p>
                        <p class="mb-1"><strong>Metode:</strong> {{ $order->payment_method ?? 'Tidak Diketahui' }}</p>
                        <p class="mb-1"><strong>Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div>
                <p class="font-weight-bold text-dark mb-1">Total Pembayaran:</p>
                <p class="fs-4 fw-bold text-dark mb-0">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <hr class="my-4" style="border-top: 1px dashed #ccc;">

        <div class="text-center">
            <a href="{{ route('home.index') }}" class="btn btn-dark px-4 py-2 rounded-3" style="font-size: 14px;">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
