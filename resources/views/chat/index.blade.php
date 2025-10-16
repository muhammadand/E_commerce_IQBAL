@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded">
        <div class="card-header bg-white border-bottom">
            <h4 class="mb-0 text-primary fw-bold">📩 Daftar Kontak</h4>
        </div>

        <ul class="list-group list-group-flush">
            @forelse ($users as $user)
                <li class="list-group-item px-4 py-3">
                    <a href="{{ route('chat.show', $user->id) }}"
                       data-user-id="{{ $user->id }}"
                       class="d-flex align-items-center text-decoration-none text-dark gap-3">
                       
                        {{-- Foto profil (inisial) --}}
                        <div class="me-3 flex-shrink-0">
                            <div class="rounded-circle bg-pink-soft text-pink d-flex align-items-center justify-content-center fw-bold text-uppercase shadow-sm"
                                 style="width: 48px; height: 48px;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        </div>

                        {{-- Nama dan status --}}
                        <div class="flex-grow-1">
                            <div class="fw-semibold text-truncate" style="font-size: 1rem;">{{ $user->name }}</div>
                            @if (isset($unreadCounts[$user->id]) && $unreadCounts[$user->id] > 0)
                                <small class="text-danger fw-semibold unread-label">Pesan belum dibaca ({{ $unreadCounts[$user->id] }})</small>
                            @endif
                        </div>

                        {{-- Badge unread --}}
                        @if (isset($unreadCounts[$user->id]) && $unreadCounts[$user->id] > 0)
                            <div class="ms-auto">
                                <span class="badge bg-danger rounded-pill unread-badge px-3 py-2">
                                    {{ $unreadCounts[$user->id] }}
                                </span>
                            </div>
                        @endif
                    </a>
                </li>
            @empty
                <li class="list-group-item text-muted text-center py-4">Belum ada kontak.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-pink-soft {
        background-color: #fdecef !important;
    }

    .text-pink {
        color: #f06292 !important;
    }

    .list-group-item:hover {
        background-color: #fff6f8;
        transition: all 0.2s ease-in-out;
    }

    .unread-badge {
        font-size: 0.75rem;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('a[data-user-id]');

        links.forEach(link => {
            link.addEventListener('click', function () {
                const userId = this.dataset.userId;

                fetch(`/chat/read-messages/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.querySelector('.unread-badge')?.remove();
                        this.querySelector('.unread-label')?.remove();
                    }
                });
            });
        });
    });
</script>
@endsection
