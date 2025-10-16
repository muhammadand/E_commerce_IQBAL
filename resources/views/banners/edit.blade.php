@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Banner</h2>

    <form action="{{ route('banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $banner->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            @if($banner->image)
                <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" width="100">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ $banner->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Nominal Diskon (%)</label>
            <input type="number" name="discount_amount" class="form-control" value="{{ $banner->discount_amount }}">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('banners.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
