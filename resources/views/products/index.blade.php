@extends('layouts.admin.app')

@section('content')
<div class="col-md-12">
    <div class="card card-round">
        <!-- Header -->
        <div class="card-header" style="background-color: #fce4ec;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="card-title text-dark fw-bold">🛍️ Product List</div>
                <div class="card-tools">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-dark" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('products.create') }}">Create</a>
                            <a class="dropdown-item" href="{{ route('discounts.index') }}">Discounts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Body -->
        <div class="card-body p-0" style="background-color: #fff0f5;">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead style="background-color: #f8bbd0; color: #4a4a4a;">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Stock</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('images/' . $product->image) }}"
                                            alt="{{ $product->name }}" width="50">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>
                                    @if ($product->discount && $product->discount->status === 'active')
                                        <del class="text-muted">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                        </del><br>
                                        <span class="text-danger fw-bold">
                                            Rp{{ number_format($product->discount->final_price, 0, ',', '.') }}
                                        </span>
                                    @else
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if($product->is_premium)
                                        <span class="badge bg-success">Premium</span>
                                    @else
                                        <span class="badge bg-secondary">Standar</span>
                                    @endif
                                </td>
                                <td>{{ $product->stock }}</td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm" style="background-color: #f48fb1; color: white;"
                                            type="button" id="actionDropdown{{ $product->id }}"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="actionDropdown{{ $product->id }}">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('products.show', $product->id) }}">View</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('products.edit', $product->id) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('products.send.email', $product->id) }}">Send to Email</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
