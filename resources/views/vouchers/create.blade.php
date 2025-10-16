@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2 class="h4 fw-bold mb-4">Tambah Voucher</h2>

            <form action="{{ route('vouchers.store') }}" method="POST">
                @csrf

                @include('vouchers.form')

                <button type="submit" class="btn  mt-3" style="background-color: #fff0f5;">Simpan</button>
            </form>

        </div>
    </div>
</div>
@endsection
