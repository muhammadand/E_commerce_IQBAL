@extends('layouts.admin.app')

@section('content')
<div class="col-md-12">
    <div class="card card-round">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">Order List</div>
                <div class="card-tools">
                    <div class="dropdown">
                        <button class="btn btn-icon btn-clean" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('products.index') }}">Products</a>
                            <a class="dropdown-item" href="{{ route('discounts.index') }}">Discounts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Produk / Bahan</th>
                            <th>Total</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp

                        {{-- TAMPILKAN ORDERS --}}
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>
                                    @if ($order->orderItems && $order->orderItems->isNotEmpty())
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($order->orderItems as $item)
                                                <li>
                                                    <i class="fas fa-tags text-success me-1"></i>
                                                    {{ $item->product->name }} – {{ $item->quantity }}x 
                                                    <span class="text-muted">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted fst-italic">Tidak ada produk</span>
                                    @endif
                                </td>
                                <td><strong>Rp{{ number_format($order->total, 0, ',', '.') }}</strong></td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="actionDropdown{{ $order->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $order->id }}">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('orders.show', $order->id) }}">
                                                    <i class="fas fa-eye me-2"></i> Lihat
                                                </a>
                                            </li>
                                            {{-- <li>
                                                <form action="{{ route('order.destroy.admin', $order->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus order ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">
                                                        <i class="fas fa-trash-alt me-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada order ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
