@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Banner</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('banners.create') }}" class="btn btn-primary mb-3">+ Tambah Banner</a>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Diskon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                        <tr>
                            <td>{{ $banner->name }}</td>
                            <td>
                                @if($banner->image)
                                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" width="80">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>{{ $banner->description ?? '-' }}</td>
                            <td>{{ $banner->discount_amount ?? 0 }}%</td>
                            <td>
                                <a href="{{ route('banners.edit', $banner) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus banner?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada banner</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
