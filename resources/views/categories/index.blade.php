@extends('layouts.admin.app')

@section('content')
<div class="col-md-12">
    <div class="card card-round">
        <div class="card-header" style="background-color: #fce4ec;">
            <div class="card-head-row card-tools-still-right">
                <div class="card-title text-dark fw-bold">Category List</div>
                <div class="card-tools">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-dark" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('categories.create') }}">Create</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead style="background-color: #f8bbd0; color: #4a4a4a;">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col" class="text-end">Created At</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $category)
                            <tr class="align-middle">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td class="text-end">{{ $category->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-pink text-white dropdown-toggle"
                                            style="background-color: #f48fb1;" 
                                            type="button"
                                            id="actionDropdownCategory{{ $category->id }}"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdownCategory{{ $category->id }}">

                                            <li>
                                                <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
                                <td colspan="4" class="text-center text-muted">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
