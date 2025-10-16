@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Tambah Banner</h2>

    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Nominal Diskon (%)</label>
            <input type="number" name="discount_amount" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('banners.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
