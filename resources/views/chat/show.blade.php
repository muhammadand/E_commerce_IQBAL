@extends('layouts.admin.app')

@section('content')
<div class="container py-3" style="max-width: 540px;">
    <div class="card border-0 shadow-sm rounded-3" style="max-height: 80vh; display: flex; flex-direction: column;">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex align-items-center justify-content-between">
            <h6 class="mb-0 fw-semibold text-pink">💬 Chat dengan {{ $user->name }}</h6>
        </div>

        <div id="messages" class="px-3 pt-3 overflow-auto" style="flex-grow: 1; min-height: 300px; max-height: 55vh;">
            @foreach ($messages as $message)
                @if ($message->from_user_id == auth()->id())
                    <div class="d-flex justify-content-end mb-2">
                        <div class="bg-pink text-white py-2 px-3 rounded-4 rounded-end-0 shadow-sm" style="max-width: 80%; font-size: 14px;">
                            {{ $message->message }}
                            <div class="text-white-50 text-end mt-1" style="font-size: 10px;">
                                {{ $message->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-start mb-2">
                        <div class="bg-light text-dark py-2 px-3 rounded-4 rounded-start-0 shadow-sm" style="max-width: 80%; font-size: 14px;">
                            {{ $message->message }}
                            <div class="text-muted mt-1" style="font-size: 10px;">
                                {{ $message->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="card-footer bg-white border-top py-2 px-3">
            <form id="chat-form" class="d-flex gap-2 align-items-center" onsubmit="sendMessage(event)">
                <input 
                    id="messageInput" 
                    type="text" 
                    placeholder="Ketik pesan..." 
                    autocomplete="off"
                    class="form-control rounded-pill border border-pink small"
                    style="font-size: 14px;"
                />
                <button 
                    type="submit" 
                    class="btn bg-pink text-white rounded-pill px-3 py-1"
                    style="font-size: 14px;"
                >
                    Kirim
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-pink {
        background-color: #f48fb1 !important;
    }
    .text-pink {
        color: #f06292 !important;
    }
    .border-pink {
        border-color: #f06292 !important;
    }
    #messages::-webkit-scrollbar {
        width: 5px;
    }
    #messages::-webkit-scrollbar-thumb {
        background: #f48fb1;
        border-radius: 3px;
    }
</style>

<script>
    const messagesEl = document.getElementById('messages');
    const inputEl = document.getElementById('messageInput');
    const userId = {{ $user->id }};
    const myId = {{ auth()->id() }};

    function scrollToBottom() {
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }
    scrollToBottom();

    async function sendMessage(event) {
        event.preventDefault();
        const message = inputEl.value.trim();
        if (!message) return;

        try {
            const res = await fetch('{{ route("send.message") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message, to_user_id: userId })
            });

            const data = await res.json();
            if (data.status === 'Message sent!') {
                appendMessage(data.message);
                inputEl.value = '';
                scrollToBottom();
            }
        } catch (error) {
            console.error(error);
        }
    }

    function appendMessage(message) {
        const div = document.createElement('div');
        div.classList.add('d-flex', 'mb-2');

        if (message.from_user_id === myId) {
            div.classList.add('justify-content-end');
            div.innerHTML = `
                <div class="bg-pink text-white py-2 px-3 rounded-4 rounded-end-0 shadow-sm" style="max-width: 80%; font-size: 14px;">
                    ${message.message}
                    <div class="text-white-50 text-end mt-1" style="font-size: 10px;">
                        ${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                    </div>
                </div>
            `;
        } else {
            div.classList.add('justify-content-start');
            div.innerHTML = `
                <div class="bg-light text-dark py-2 px-3 rounded-4 rounded-start-0 shadow-sm" style="max-width: 80%; font-size: 14px;">
                    ${message.message}
                    <div class="text-muted mt-1" style="font-size: 10px;">
                        ${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                    </div>
                </div>
            `;
        }

        messagesEl.appendChild(div);
    }

    async function fetchMessages() {
        try {
            const res = await fetch(`/chat/messages/${userId}`);
            const messages = await res.json();

            messagesEl.innerHTML = '';
            messages.forEach(appendMessage);
            scrollToBottom();
        } catch (error) {
            console.error('Fetch messages error:', error);
        }
    }

    setInterval(fetchMessages, 3000);
</script>
@endsection
