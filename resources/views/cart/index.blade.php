<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fffaf5] text-[#49352b]">

    <div class="min-h-screen">

        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-[#eee4d8]">
            <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
                <a href="/" class="text-2xl font-bold text-[#75452e]">
                    KueKampus.id
                </a>

                <a href="{{ route('produk.index') }}"
                    class="text-sm font-medium text-[#75452e] hover:underline">
                    Lanjut Belanja
                </a>
            </div>
        </header>

        <!-- Content -->
        <main class="max-w-6xl mx-auto px-6 py-10">

            <h1 class="text-3xl font-bold mb-2">Keranjang Belanja</h1>
            <p class="text-[#8b7567] mb-8">
                Periksa kembali produk yang ingin kamu pesan.
            </p>

            @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-100 px-5 py-3 text-green-700">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-6 rounded-lg bg-red-100 px-5 py-3 text-red-700">
                {{ session('error') }}
            </div>
            @endif

            @if (count($cart) > 0)

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Daftar Produk -->
                <div class="lg:col-span-2 space-y-4">

                    @foreach ($cart as $id => $item)

                    <div class="bg-white border border-[#eee4d8] rounded-xl p-5
                                        flex flex-col sm:flex-row gap-5 shadow-sm">

                        <!-- Gambar -->
                        <div class="w-full sm:w-32 h-32 bg-[#f7e8dc] rounded-lg overflow-hidden shrink-0">

                            @if ($item['image'])
                            <img
                                src="{{ asset('storage/' . $item['image']) }}"
                                alt="{{ $item['name'] }}"
                                class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-sm text-[#a58b79]">
                                Tidak ada gambar
                            </div>
                            @endif

                        </div>

                        <!-- Informasi Produk -->
                        <div class="flex-1">

                            <h2 class="text-lg font-semibold">
                                {{ $item['name'] }}
                            </h2>

                            <p class="text-[#75452e] font-bold mt-2">
                                Rp{{ number_format($item['price'], 0, ',', '.') }}
                            </p>

                            <div class="flex flex-wrap items-center justify-between gap-4 mt-5">

                                <!-- Form Update Quantity -->
                                <form action="{{ route('cart.update', $id) }}"
                                    method="POST"
                                    class="flex items-center gap-3">

                                    @csrf
                                    @method('PATCH')

                                    <label for="quantity-{{ $id }}"
                                        class="text-sm">
                                        Jumlah:
                                    </label>

                                    <input
                                        type="number"
                                        id="quantity-{{ $id }}"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        class="w-20 rounded-lg border border-[#d9c7b8] px-3 py-2">

                                    <button type="submit"
                                        class="text-sm font-medium text-[#75452e] hover:underline">
                                        Perbarui
                                    </button>

                                </form>

                                <!-- Hapus Produk -->
                                <form action="{{ route('cart.remove', $id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-sm text-red-600 hover:underline">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                        <!-- Subtotal -->
                        <div class="sm:text-right">
                            <p class="text-sm text-[#8b7567]">Subtotal</p>

                            <p class="font-bold text-lg">
                                Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </p>
                        </div>

                    </div>

                    @endforeach

                </div>

                <!-- Ringkasan Belanja -->
                <div class="bg-white border border-[#eee4d8] rounded-xl p-6 shadow-sm h-fit">

                    <h2 class="text-xl font-bold mb-5">
                        Ringkasan Belanja
                    </h2>

                    @php
                    $total = 0;

                    foreach ($cart as $item) {
                    $total += $item['price'] * $item['quantity'];
                    }
                    @endphp

                    <div class="flex justify-between text-sm mb-4">
                        <span>Total Produk</span>
                        <span>{{ array_sum(array_column($cart, 'quantity')) }} item</span>
                    </div>

                    <div class="border-t border-[#eee4d8] pt-4 flex justify-between gap-3">
                        <span class="font-semibold">Total Harga</span>

                        <span class="font-bold text-xl text-[#75452e]">
                            Rp{{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ route('checkout.index') }}"
                        class="block w-full mt-6 rounded-lg bg-[#75452e] py-3
           text-center font-semibold text-white hover:bg-[#49352b]">
                        Lanjut ke Checkout
                    </a>

                    <p class="text-xs text-center text-[#a58b79] mt-3">
                        Periksa kembali pesanan sebelum melanjutkan.
                    </p>

                </div>

            </div>

            @else

            <!-- Keranjang Kosong -->
            <div class="bg-white border border-[#eee4d8] rounded-xl p-12 text-center">

                <h2 class="text-xl font-semibold mb-3">
                    Keranjang Belanja Masih Kosong
                </h2>

                <p class="text-[#8b7567] mb-6">
                    Yuk, pilih kue favoritmu dan tambahkan ke keranjang.
                </p>

                <a href="{{ route('produk.index') }}"
                    class="inline-block rounded-lg bg-[#75452e] px-6 py-3
                              font-semibold text-white hover:bg-[#49352b]">
                    Mulai Belanja
                </a>

            </div>

            @endif

        </main>

    </div>

</body>

</html>