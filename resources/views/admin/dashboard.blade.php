<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#fffaf5] text-[#49352b]">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#49352b] text-white hidden md:flex flex-col">

        <div class="px-6 py-7 border-b border-white/10">
            <h1 class="text-2xl font-bold">
                KueKampus<span class="text-[#d69b72]">.id</span>
            </h1>
            <p class="text-sm text-white/60 mt-1">Administrator Panel</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">

            <p class="text-xs uppercase tracking-wider text-white/40 px-3 mb-3">
                Menu Utama
            </p>

            <a href="{{ route('admin.dashboard') }}"
               class="block rounded-lg bg-[#75452e] px-4 py-3 text-white">
                Dashboard
            </a>

            <a href="{{ route('products.index') }}"
               class="block rounded-lg px-4 py-3 text-white/80 hover:bg-white/10">
                Kelola Produk
            </a>

            <a href="{{ route('categories.index') }}"
               class="block rounded-lg px-4 py-3 text-white/80 hover:bg-white/10">
                Kelola Kategori
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="block rounded-lg px-4 py-3 text-white/80 hover:bg-white/10">
                Manajemen Pesanan
            </a>

        </nav>

        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full rounded-lg bg-white/10 px-4 py-3 text-left text-white hover:bg-white/20">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 min-w-0">

        <!-- Header -->
        <header class="bg-white px-5 md:px-8 py-5 shadow-sm flex flex-wrap justify-between items-center gap-3">
            <div>
                <h2 class="text-xl font-bold">Dashboard Admin</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Ringkasan pengelolaan KueKampus.id
                </p>
            </div>

            <div class="text-sm text-[#75452e] font-semibold">
                Administrator
            </div>
        </header>

        <div class="p-5 md:p-8">

            <!-- Sambutan -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-[#49352b]">
                    Selamat Datang, Admin!
                </h1>

                <p class="text-gray-500 mt-2">
                    Kelola produk, kategori, dan pesanan pelanggan melalui dashboard ini.
                </p>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

                <div class="bg-white rounded-xl p-6 shadow-sm border border-[#f0e4da]">
                    <p class="text-sm text-gray-500">Total Pesanan</p>
                    <h3 class="text-3xl font-bold mt-3 text-[#75452e]">
                        {{ $totalOrders }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">Seluruh pesanan pelanggan</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-[#f0e4da]">
                    <p class="text-sm text-gray-500">Total Produk</p>
                    <h3 class="text-3xl font-bold mt-3 text-[#75452e]">
                        {{ $totalProducts }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">Produk yang tersedia</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-[#f0e4da]">
                    <p class="text-sm text-gray-500">Total Kategori</p>
                    <h3 class="text-3xl font-bold mt-3 text-[#75452e]">
                        {{ $totalCategories }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">Kategori produk</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-[#f0e4da]">
                    <p class="text-sm text-gray-500">Pesanan Menunggu</p>
                    <h3 class="text-3xl font-bold mt-3 text-[#c47b42]">
                        {{ $pendingOrders }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">Pesanan berstatus pending</p>
                </div>

            </div>

            <!-- Menu Pengelolaan -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4">Pengelolaan Toko</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <a href="{{ route('products.index') }}"
                       class="bg-white rounded-xl p-6 shadow-sm border border-[#f0e4da] hover:shadow-md transition">
                        <h3 class="font-bold text-lg">Kelola Produk</h3>
                        <p class="text-sm text-gray-500 mt-2">
                            Tambah, ubah, dan hapus data produk kue.
                        </p>
                        <p class="text-[#9a5938] font-semibold text-sm mt-5">
                            Buka Pengelolaan →
                        </p>
                    </a>

                    <a href="{{ route('categories.index') }}"
                       class="bg-white rounded-xl p-6 shadow-sm border border-[#f0e4da] hover:shadow-md transition">
                        <h3 class="font-bold text-lg">Kelola Kategori</h3>
                        <p class="text-sm text-gray-500 mt-2">
                            Atur kategori untuk mengelompokkan produk.
                        </p>
                        <p class="text-[#9a5938] font-semibold text-sm mt-5">
                            Buka Pengelolaan →
                        </p>
                    </a>

                    <a href="{{ route('admin.orders.index') }}"
                       class="bg-white rounded-xl p-6 shadow-sm border border-[#f0e4da] hover:shadow-md transition">
                        <h3 class="font-bold text-lg">Manajemen Pesanan</h3>
                        <p class="text-sm text-gray-500 mt-2">
                            Lihat detail pesanan dan perbarui status pengiriman.
                        </p>
                        <p class="text-[#9a5938] font-semibold text-sm mt-5">
                            Buka Pengelolaan →
                        </p>
                    </a>

                </div>
            </div>

            <!-- Informasi -->
            <div class="bg-[#f5e6d9] rounded-xl p-6">
                <h2 class="font-bold text-lg">Informasi Dashboard</h2>
                <p class="text-sm text-[#80685a] mt-2 leading-relaxed">
                    Dashboard ini digunakan administrator untuk mengelola
                    data produk, kategori, dan pesanan pada platform
                    e-commerce KueKampus.id.
                </p>
            </div>

        </div>

    </main>

</div>

</body>
</html>
