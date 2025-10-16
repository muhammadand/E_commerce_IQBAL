@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2 class="h4 fw-bold mb-4">Edit Voucher</h2>

            <form action="{{ route('vouchers.update', $voucher) }}" method="POST">
                @csrf
                @method('PUT')

                @include('vouchers.form', ['voucher' => $voucher])

                <button type="submit" class="btn  mt-3" style="background-color: #fff0f5;">Update</button>
            </form>

        </div>
    </div>
</div>
@endsection
