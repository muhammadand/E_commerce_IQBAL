@extends('layoutapp')

@section('content')
<div class="container">
    <h4 class="mb-4">Wishlist Saya</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @foreach($wishlists as $wishlist)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $wishlist->product->image) }}" class="card-img-top" alt="{{ $wishlist->product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $wishlist->product->name }}</h5>
                        <p class="card-text">Rp{{ number_format($wishlist->product->price, 0, ',', '.') }}</p>
                        <form action="{{ route('wishlist.remove', $wishlist->product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus dari Wishlist</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $wishlists->links() }}
    </div>
</div>
@endsection
