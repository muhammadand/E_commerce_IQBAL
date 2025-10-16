@extends('layouts.admin.app')

@section('content')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-header">
            <h4>Edit Discount</h4>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="promo_name" class="form-label">Promo Name</label>
                    <input type="text" name="promo_name" class="form-control" value="{{ old('promo_name', $discount->promo_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="product_id" class="form-label">Product</label>
                    <select name="product_id" class="form-select" required>
                        <option value="">-- Select Product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $product->id == $discount->product_id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="discount_type" class="form-label">Discount Type</label>
                    <select name="discount_type" class="form-select" required>
                        <option value="percent" {{ $discount->discount_type == 'percent' ? 'selected' : '' }}>Percent (%)</option>
                        <option value="fixed" {{ $discount->discount_type == 'fixed' ? 'selected' : '' }}>Fixed (Rp)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="discount_value" class="form-label">Discount Value</label>
                    <input type="number" name="discount_value" class="form-control" value="{{ old('discount_value', $discount->discount_value) }}" required min="0">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ $discount->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $discount->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3 text-end">
                    <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update Discount</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
