@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h2 class="h4 fw-bold mb-4">Daftar Voucher</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('vouchers.create') }}" class="btn  mb-3" style="background-color: #fff0f5;">+ Tambah Voucher</a>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Diskon</th>
                    <th>Tipe</th>
                    <th>Kadaluarsa</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vouchers as $voucher)
                    <tr>
                        <td class="fw-semibold">{{ $voucher->code }}</td>
                        <td>{{ $voucher->discount_value }}</td>
                        <td>{{ ucfirst($voucher->discount_type) }}</td>
                        <td>{{ $voucher->expires_at ? $voucher->expires_at->format('d M Y') : '-' }}</td>
                        <td>
                            <span class="badge {{ $voucher->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $voucher->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('vouchers.edit', $voucher) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        
                            <form action="{{ route('vouchers.toggle', $voucher->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-{{ $voucher->is_active ? 'warning' : 'success' }}">
                                    {{ $voucher->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        
                            <form action="{{ route('vouchers.destroy', $voucher) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus voucher ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada voucher</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
