@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4 text-dark border-bottom pb-2">📦 Daftar Pesanan Saya</h3>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            Belum ada pesanan yang dibuat.
        </div>
    @else
        @foreach ($orders as $order)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <strong>👤 Nama:</strong><br>
                            {{ $order->user->name ?? 'Tidak Diketahui' }}
                        </div>
                        <div class="col-md-4">
                            <strong>📦 Resi:</strong><br> klik untuk cek resi :
                            @if($order->resi)
                            <a href="https://cekresi.com/?resi={{ $order->resi }}" target="_blank">
                                {{ $order->resi }}
                            </a>
                        @else
                            -
                        @endif
                        </div>
                        <div class="col-md-4">
                            <strong>📍 Alamat:</strong><br>
                            {{ $order->address }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>🕒 Tanggal:</strong><br>
                            {{ $order->created_at->format('d-m-Y H:i') }}
                        </div>
                        <div class="col-md-8">
                            <strong>🛍️ Produk:</strong><br>
                            <ul class="list-unstyled mb-0">
                                @foreach ($order->orderItems as $item)
                                    <li>
                                        @if ($item->product)
                                            {{ $item->product->name }} ({{ $item->quantity }}) 
                                            @if($item->product->is_premium)
                                                <span class="badge bg-warning text-dark ms-1">Premium</span>
                                            @endif
                                        @else
                                            <em class="text-muted">Item tidak diketahui</em>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>💳 Status Pembayaran:</strong><br>
                            <span class="badge rounded-pill 
                                text-bg-{{ $order->payment_status == 'paid' ? 'success' : 
                                           ($order->payment_status == 'failed' ? 'danger' : 'warning') }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <strong>🚚 Status Pesanan:</strong><br>
                            <span class="badge rounded-pill 
                                text-bg-{{ $order->status == 'completed' ? 'success' : 
                                           ($order->status == 'shipped' ? 'info' : 'secondary') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <strong>💰 Total:</strong><br>
                            <span class="text-success fw-bold">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-2">
                        @if($order->payment_status == 'unpaid')
                            <form action="{{ route('payment.proses', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" title="Bayar">
                                    <i class="fa fa-credit-card me-1"></i> Bayar
                                </button>
                            </form>
                        @else
                            <span class="btn btn-outline-success btn-sm disabled">
                                <i class="fa fa-check-circle me-1"></i> Lunas
                            </span>
                        @endif

                        @if ($order->status !== 'accepted')
                            <form action="{{ route('orders.destroy.home', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                    <i class="fa fa-trash me-1"></i> Batal
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
