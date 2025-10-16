@extends('layouts.admin.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Laporan Penjualan</h2>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Produk</small>
                    <h5 class="card-title">{{ $totalProducts }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Order</small>
                    <h5 class="card-title">{{ $totalOrders }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Pendapatan</small>
                    <h5 class="card-title">Rp{{ number_format($totalOrder, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Kolom: Top Produk Terlaris -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Top 5 Produk Terlaris</h5>
                        <ul class="list-group">
                            @foreach($topProducts as $product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $product->name }}
                                    <span class="badge bg-success rounded-pill">{{ $product->total_sold }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kolom: Top Pelanggan Aktif -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Top 5 Pelanggan Aktif</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jumlah Order</th>
                                        <th>Total Belanja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topCustomers as $cust)
                                    <tr>
                                        <td>{{ $cust->name }}</td>
                                        <td>{{ $cust->total_orders }}</td>
                                        <td>Rp{{ number_format($cust->total_spent, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-2">
            <label for="period" class="form-label">Periode</label>
            <select name="period" id="period" class="form-select">
                <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>Harian</option>
                <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>Tahunan</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn  w-100" style="background-color: #fff0f5;">Filter</button>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <a href="{{route('sales.print')}}" class="btn  w-100"style="background-color: #fff0f5;">Print</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col" class="text-end">Jumlah Terjual</th>
                    <th scope="col" class="text-end">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($sale->period)->format('d-m-Y') }}</td>
                    <td>{{ $sale->item_name }}</td>
                    <td class="text-end">{{ $sale->total_quantity_sold }}</td>
                    <td class="text-end">Rp{{ number_format($sale->total_revenue, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada data penjualan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
