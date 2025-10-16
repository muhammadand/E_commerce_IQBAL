<!-- Tambahkan ini di <head> -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    
        .chat-card-header {
            background-color: #f06292;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }
    
        .chat-card-body {
            background-color: #fff0f5;
        }
    
        .chat-send-btn {
            background-color: #f06292;
            border: none;
        }
    
        .chat-send-btn:hover {
            background-color: #ec407a;
        }
    
        .bubble-user-msg {
            background-color: #f06292;
            color: white;
            border-radius: 1rem 1rem 0 1rem;
        }
    
        .bubble-admin-msg {
            background-color: #e0e0e0;
            color: black;
            border-radius: 1rem 1rem 1rem 0;
        }
    </style>
    
    <!-- Bubble Chat Floating Button + Chat Box -->
    <div x-data="{ open: false }" style="position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 1055;">
        <!-- Toggle Button -->
        <button 
            @click="open = !open" 
            class="btn shadow rounded-circle d-flex align-items-center justify-content-center"
            style="width: 55px; height: 55px; background-color: #f06292; color: white;"
        >
            <i class="fas fa-comment-dots fa-lg"></i>
        </button>
    
        <!-- Chat Box -->
        <div 
            x-show="open"
            x-cloak
            @click.outside="open = false"
            x-transition
            class="card border-0 shadow-lg"
            style="width: 320px; max-height: 500px; position: absolute; bottom: 70px; right: 0; border-radius: 0.75rem;"
        >
            <!-- Header -->
            <div class="card-header chat-card-header d-flex justify-content-between align-items-center px-3 py-2">
                <strong>Chat Admin</strong>
                <button class="btn btn-sm btn-light" @click="open = false">
                    <i class="fas fa-times text-danger"></i>
                </button>
            </div>
    
            <!-- Chat Body -->
            <div id="bubble-messages" class="card-body chat-card-body overflow-auto px-3 py-2" style="height: 280px;">
                <!-- Chat messages will be inserted here -->
            </div>
    
            <!-- Input -->
            <div class="card-footer bg-white border-0">
                <form id="bubble-form" class="d-flex gap-2 m-0" onsubmit="sendBubbleMessage(event)">
                    <input 
                        id="bubbleInput" 
                        type="text" 
                        placeholder="Tulis pesan..." 
                        class="form-control rounded-pill"
                    />
                    <button type="submit" class="btn chat-send-btn text-white rounded-pill px-3">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    
    <!-- Scripts -->
    <script>
        const bubbleInput = document.getElementById('bubbleInput');
        const bubbleMessages = document.getElementById('bubble-messages');
    
        function scrollBubbleBottom() {
            bubbleMessages.scrollTop = bubbleMessages.scrollHeight;
        }
    
        async function sendBubbleMessage(event) {
            event.preventDefault();
            const message = bubbleInput.value.trim();
            if (!message) return;
    
            try {
                const res = await fetch('{{ route("send.message") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message, to_user_id: 1 }) // Ganti ID jika perlu
                });
    
                const data = await res.json();
                if (data.status === 'Message sent!') {
                    appendBubbleMessage(data.message);
                    bubbleInput.value = '';
                    scrollBubbleBottom();
                }
            } catch (err) {
                console.error(err);
            }
        }
    
        function appendBubbleMessage(message) {
            const myId = {{ auth()->id() }};
            const time = new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
            const msgEl = document.createElement('div');
            msgEl.className = `d-flex mb-2 ${message.from_user_id === myId ? 'justify-content-end' : 'justify-content-start'}`;
    
            msgEl.innerHTML = `
                <div class="px-3 py-2 rounded shadow-sm ${message.from_user_id === myId ? 'bg-dark text-white' : 'bg-light text-dark'}"
                     style="max-width: 75%;">
                    <div class="small">${message.message}</div>
                    <div class="text-end small text-muted mt-1" style="font-size: 0.7rem;">${time}</div>
                </div>
            `;
    
            bubbleMessages.appendChild(msgEl);
        }
    
        async function fetchBubbleMessages() {
            try {
                const res = await fetch(`/chat/messages/1`); // Ganti dengan ID target jika perlu
                const messages = await res.json();
    
                bubbleMessages.innerHTML = '';
                messages.forEach(appendBubbleMessage);
                scrollBubbleBottom();
            } catch (err) {
                console.error('Failed to fetch messages', err);
            }
        }
    
        setInterval(fetchBubbleMessages, 3000);
    </script>
    
    <!-- Alpine.js (wajib untuk x-data, x-show, dsb) -->
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
    