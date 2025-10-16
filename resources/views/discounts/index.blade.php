@extends('layouts.admin.app')

@section('content')
<div class="col-md-12">
    <div class="card card-round">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">Daftar Diskon</div>
            <div class="card-tools">
                <div class="dropdown">
                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('discounts.create') }}">Create</a>
                 
                    </div>
                </div>
            </div>
        
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Promo</th>
                        <th>Produk</th>
                        <th>Nilai</th>
                        <th>Harga Setelah Diskon</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discounts as $i => $d)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $d->promo_name }}</td>
                        <td>{{ $d->product->name ?? '-' }}</td>
                        <td>
                            @if($d->discount_type == 'percent')
                                {{ $d->discount_value }}%
                            @else
                                Rp {{ number_format($d->discount_value) }}
                            @endif
                        </td>
                        <td>Rp {{ number_format($d->final_price) }}</td>
                        <td>
                            <span class="badge {{ $d->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($d->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="accordion" id="accordionActions{{ $d->id }}">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header" id="heading{{ $d->id }}">
                                        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $d->id }}" aria-expanded="false" aria-controls="collapse{{ $d->id }}">
                                            Aksi
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $d->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $d->id }}" data-bs-parent="#accordionActions{{ $d->id }}">
                                        <div class="accordion-body p-2">
                                            <form action="{{ route('discounts.toggle', $d->id) }}" method="POST" class="mb-1">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm w-100 {{ $d->status == 'active' ? 'btn-warning' : 'btn-success' }}">
                                                    {{ $d->status == 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                        
                                            <a href="{{ route('discounts.edit', $d->id) }}" class="btn btn-sm btn-info w-100 mb-1">Edit</a>
                        
                                            <form action="{{ route('discounts.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus diskon ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger w-100">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                    </tr>
                    @endforeach
                    @if($discounts->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada diskon.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
