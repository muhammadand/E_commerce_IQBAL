<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/bg.jpeg') }}')">


    <div class="flex h-screen bg-amber-100 bg-opacity-80 ">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed top-0 left-0 z-30 h-full w-64 transform bg-amber-200 shadow-xl transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:flex md:flex-col md:rounded-xl p-4 text-gray-700">
            <div class="flex items-center justify-between mb-6 md:hidden">
                <h5 class="text-xl font-semibold text-blue-gray-900">Admin Unique</h5>
                <button id="sidebarCloseBtn" aria-label="Close sidebar"
                    class="text-gray-700 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 rounded">
                    ✕
                </button>
            </div>
            <nav class="flex flex-col gap-1 font-sans text-base text-blue-gray-700">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-grey-100"fill="currentColor"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.25 2.25a.75.75 0 000 1.5H3v10.5a3 3 0 003 3h1.21l-1.172 3.513a.75.75 0 001.424.474l.329-.987h8.418l.33.987a.75.75 0 001.422-.474l-1.17-3.513H18a3 3 0 003-3V3.75h.75a.75.75 0 000-1.5H2.25zm6.04 16.5l.5-1.5h6.42l.5 1.5H8.29zm7.46-12a.75.75 0 00-1.5 0v6a.75.75 0 001.5 0v-6zm-3 2.25a.75.75 0 00-1.5 0v3.75a.75.75 0 001.5 0V9zm-3 2.25a.75.75 0 00-1.5 0v1.5a.75.75 0 001.5 0v-1.5z" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('products.index') }}"
                    class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                    <!-- Icon Kursi -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 20v-6a2 2 0 012-2h8a2 2 0 012 2v6m-2 0v-4H8v4M4 20h16" />
                    </svg>
                    Produk
                </a>

                <a href="{{ route('categories.index') }}"
                    class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="currentColor"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.912 3a3 3 0 00-2.868 2.118l-2.411 7.838a3 3 0 00-.133.882V18a3 3 0 003 3h15a3 3 0 003-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0017.088 3H6.912zm13.823 9.75l-2.213-7.191A1.5 1.5 0 0017.088 4.5H6.912a1.5 1.5 0 00-1.434 1.059L3.265 12.75H6.11a3 3 0 012.684 1.658l.256.513a1.5 1.5 0 001.342.829h3.218a1.5 1.5 0 001.342-.83l.256-.512a3 3 0 012.684-1.658h2.844z" />
                    </svg>
                    Kategori

                </a>
                <a href="{{ route('sales.report') }}"
                    class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m4 2v-4m4 2v-6M3 7h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Laporan
                </a>


                <a href="{{ route('orders.index') }}"
                    class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="currentColor"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.912 3a3 3 0 00-2.868 2.118l-2.411 7.838a3 3 0 00-.133.882V18a3 3 0 003 3h15a3 3 0 003-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0017.088 3H6.912zm13.823 9.75l-2.213-7.191A1.5 1.5 0 0017.088 4.5H6.912a1.5 1.5 0 00-1.434 1.059L3.265 12.75H6.11a3 3 0 012.684 1.658l.256.513a1.5 1.5 0 001.342.829h3.218a1.5 1.5 0 001.342-.83l.256-.512a3 3 0 012.684-1.658h2.844z" />
                    </svg>
                    Pesanan
                    <span id="order-count"
                        class="ml-auto px-2 py-0.5 text-xs font-bold uppercase rounded-full bg-blue-200 text-blue-800 select-none">0</span>
                    <!-- Riwayat Pesanan (ikon jam / histori) -->
                    <a href="{{ route('riwayat.index') }}"
                        class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Riwayat Pesanan

                    </a>

                    <!-- Users (ikon orang / pengguna) -->
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0v.75H4.5v-.75z" />
                        </svg>
                        Users

                    </a>

                    <!-- Banners (ikon gambar / promosi) -->
                    <a href="{{ route('banners.index') }}"
                        class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-purple-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 4.5h18M3 19.5h18M3 4.5l9 7.5L21 4.5M3 19.5l6-6 3 2.25L18 13.5l3 6" />
                        </svg>
                        Banners
                    </a>

                    <!-- Voucher (ikon tiket / diskon) -->
                    <a href="{{ route('vouchers.index') }}"
                        class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-pink-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7.5h18M3 7.5A1.5 1.5 0 014.5 6h15A1.5 1.5 0 0121 7.5v2.25a2.25 2.25 0 010 4.5V16.5A1.5 1.5 0 0119.5 18h-15A1.5 1.5 0 013 16.5v-2.25a2.25 2.25 0 010-4.5V7.5z" />
                        </svg>
                        Voucher
                    </a>

                    <!-- Chat (ikon pesan / bubble chat) -->
                    <a href="{{ route('chat.index') }}"
                        class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-blue-50 hover:text-blue-900 focus:bg-blue-50 focus:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 9.75h6.75m-6.75 3h3.375M2.25 12c0 5.108 4.642 9.25 10.25 9.25a10.17 10.17 0 004.045-.823l4.348 1.227-1.227-4.348A9.965 9.965 0 0022.5 12c0-5.108-4.642-9.25-10.25-9.25S2.25 6.892 2.25 12z" />
                        </svg>
                        Chat
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-red-50 hover:text-red-900 focus:bg-red-50 focus:text-red-900 w-full text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16 13v-2H7V8l-5 4 5 4v-3h9zM19 3h-8v2h8v14h-8v2h8a2 2 0 002-2V5a2 2 0 00-2-2z" />
                            </svg>
                            Logout
                        </button>
                    </form>





            </nav>
        </aside>

        <!-- Content -->
        <div class="flex flex-col flex-1 md:pl-50">
            <header class="sticky top-0 z-20 flex items-center justify-between gap-4 bg-white p-4 shadow-md md:hidden">
                <button id="sidebarOpenBtn" aria-label="Open sidebar"
                    class="text-gray-700 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 rounded">
                    ☰
                </button>
                <h1 class="text-lg font-semibold text-gray-900">Dashboard</h1>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')

            </main>
        </div>

        <script>
            const sidebar = document.getElementById('sidebar');
            const sidebarOpenBtn = document.getElementById('sidebarOpenBtn');
            const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');

            sidebarOpenBtn.addEventListener('click', () => {
                sidebar.classList.remove('-translate-x-full');
            });

            sidebarCloseBtn.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
            });

            // Initially hide sidebar on mobile
            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
            }

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('-translate-x-full');
                } else {
                    sidebar.classList.add('-translate-x-full');
                }
            });
        </script>
    </div>



</body>

</html>
