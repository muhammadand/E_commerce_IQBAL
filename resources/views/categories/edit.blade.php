@extends('layouts.admin.app')

@section('content')
<div class="col-md-12">
    <div class="card card-round">
        <!-- Header -->
        <div class="card-header" style="background-color: #fce4ec;">
            <div class="card-head-row card-tools-still-right">
                <div class="card-title text-dark fw-bold">✏️ Edit Category</div>
            </div>
        </div>

        <!-- Body Form -->
        <div class="card-body" style="background-color: #fff0f5;">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label text-dark fw-semibold">Category Name</label>
                    <input type="text" name="name" class="form-control border-pink"
                        value="{{ $category->name }}" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn" style="background-color: #f48fb1; color: white;">
                        ✅ Update
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Style -->
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
