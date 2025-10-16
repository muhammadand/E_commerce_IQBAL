@extends('layouts.admin.app')

@section('content')
<div class="col-md-12">
    <div class="card card-round">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">Order List</div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Name</th>
                            <th>Products</th>
                            <th>Note</th>
                            <th>Total</th>
                            <th>Resi</th>
                            <th>Status Pembayaran</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $index => $order)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $order->user->name }}</td>
                                <td>
                                    @if ($order->orderItems && $order->orderItems->isNotEmpty())
                                        <ul class="mb-0 ps-3">
                                            @foreach ($order->orderItems as $item)
                                                <li>
                                                    {{ $item->product->name ?? 'Nama Produk Tidak Tersedia' }}
                                                    - {{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}
                                                    
                                                    @if(optional($item->product)->is_premium)
                                                        <span class="text-danger fw-bold">(Premium)</span>
                                                    @endif

                                                    <!-- Tampilkan produk dalam bundling jika ada -->
                                                    @if($item->bundle)
                                                        <ul class="ps-3">
                                                            @foreach ($item->bundle->products as $bundledProduct)
                                                                <li>
                                                                    {{ $bundledProduct->name }} - Rp{{ number_format($bundledProduct->price, 0, ',', '.') }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No products</span>
                                    @endif
                                </td>
                                <td class="text-center">{{$order->note}}</td>
                                <td class="text-center">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('orders.updateResi', $order->id) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <input 
                                            type="text" 
                                            name="resi" 
                                            class="form-control form-control-sm me-2" 
                                            placeholder="Input Resi" 
                                            style="width: 250px;" 
                                            value="{{ $order->resi }}"
                                        >
                                        <button type="submit" class="btn btn-sm " style="background-color: #fff0f5;">Save</button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ 
                                        $order->payment_status == 'paid' ? 'success' : 
                                        ($order->payment_status == 'failed' ? 'danger' : 
                                        ($order->status == 'shipped' ? 'info' : 'warning')) 
                                    }}">
                                        {{ ucfirst($order->payment_status == 'paid' ? 'Paid' : ($order->payment_status == 'failed' ? 'Failed' : $order->status)) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto; margin: auto;">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </form>
                                </td>
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
                                                    View
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('order.destroy', $order->id) }}" method="POST" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center my-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
