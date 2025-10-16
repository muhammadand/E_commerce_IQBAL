@extends('layouts.admin.app')

@section('content')
<div class="col-md-8 offset-md-2">
    <div class="card card-round">
        <div class="card-header">
            <h4 class="card-title">Buat Promo Diskon</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('discounts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama Promo</label>
                    <input type="text" name="promo_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Pilih Produk</label>
                    <select name="product_id" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Rp {{ number_format($product->price) }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jenis Diskon</label>
                    <select name="discount_type" class="form-control" required>
                        <option value="percent">Persentase (%)</option>
                        <option value="fixed">Potongan Langsung (Rp)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nilai Diskon</label>
                    <input type="number" name="discount_value" class="form-control" min="0" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Diskon</button>
            </form>
        </div>
    </div>
</div>
@endsection
