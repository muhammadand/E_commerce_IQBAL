@extends('layouts.admin.app')

@section('content')
<div class="col-md-12">
    <div class="card card-round">
        <!-- Header -->
        <div class="card-header" style="background-color: #fce4ec;">
            <div class="card-head-row card-tools-still-right">
                <div class="card-title text-dark fw-bold">✏️ Edit Product</div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body" style="background-color: #fff0f5;">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label text-dark fw-semibold">Name</label>
                    <input type="text" class="form-control border-pink" id="name" name="name" value="{{ $product->name }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label text-dark fw-semibold">Description</label>
                    <textarea class="form-control border-pink" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label text-dark fw-semibold">Price</label>
                    <input type="text" class="form-control border-pink" id="price" name="price" value="{{ $product->price }}">
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label text-dark fw-semibold">Stock</label>
                    <input type="text" class="form-control border-pink" id="stock" name="stock" value="{{ $product->stock }}">
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label text-dark fw-semibold">Category</label>
                    <select name="category_id" id="category_id" class="form-control border-pink">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark fw-semibold">Jenis Produk</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_premium" id="premium1" value="1" {{ $product->is_premium == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="premium1">Premium</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_premium" id="premium0" value="0" {{ $product->is_premium == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="premium0">Biasa</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label text-dark fw-semibold">Image</label>
                    <input type="file" class="form-control border-pink" id="image" name="image">
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn" style="background-color: #f48fb1; color: white;">💾 Update</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional style -->
<style>
    .border-pink {
        border: 1px solid #f8bbd0 !important;
    }

    .form-control:focus {
        border-color: #f48fb1;
        box-shadow: 0 0 0 0.15rem rgba(244, 143, 177, 0.25);
    }
</style>
@endsection
