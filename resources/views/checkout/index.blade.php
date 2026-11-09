<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#fffaf5] text-[#49352b]">

    <header class="border-b border-[#f0e5dc] bg-white px-6 py-5 md:px-16">
        <div class="flex items-center justify-between">
            <a href="/" class="text-2xl font-bold">
                KueKampus<span class="text-[#c98f69]">.id</span>
            </a>

            <a href="{{ route('cart.index') }}"
                class="text-sm font-medium text-[#805039] hover:text-[#b56b52]">
                Kembali ke Keranjang
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-6 py-10">

        <!-- Pesan Error -->
        @if (session('error'))
        <div class="mb-6 rounded-lg bg-red-100 px-5 py-3 text-red-700">
            {{ session('error') }}
        </div>
        @endif

        <!-- Pesan Validasi -->
        @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-100 px-5 py-3 text-red-700">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <h1 class="mb-2 text-3xl font-bold">Checkout</h1>
        <p class="mb-8 text-[#806d61]">
            Lengkapi informasi pengiriman untuk melanjutkan pesanan.
        </p>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

            <!-- Form Alamat -->
            <div class="rounded-xl border border-[#eadbd0] bg-white p-6 md:col-span-2">

                <h2 class="mb-5 text-xl font-bold">Informasi Pengiriman</h2>

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-semibold">
                            Nama Penerima
                        </label>
                        <input type="text"
                            value="{{ auth()->user()->name }}"
                            class="w-full rounded-lg border border-[#eadbd0] bg-[#fffaf5] px-4 py-3 outline-none focus:border-[#805039]"
                            readonly>
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-semibold">
                            Alamat Pengiriman
                        </label>
                        <textarea name="shipping_address" rows="4"
                            placeholder="Masukkan alamat lengkap pengiriman..."
                            class="w-full rounded-lg border border-[#eadbd0] px-4 py-3 outline-none focus:border-[#805039]"
                            required></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-semibold">
                            Catatan Pesanan (Opsional)
                        </label>
                        <textarea name="notes" rows="3"
                            placeholder="Tambahkan catatan jika diperlukan..."
                            class="w-full rounded-lg border border-[#eadbd0] px-4 py-3 outline-none focus:border-[#805039]"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full rounded-lg bg-[#75452e] px-5 py-3
           font-semibold text-white transition hover:bg-[#49352b]">
                        Buat Pesanan
                    </button>

                </form>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="h-fit rounded-xl border border-[#eadbd0] bg-white p-6">

                <h2 class="mb-5 text-xl font-bold">Ringkasan Pesanan</h2>

                @php
                $total = 0;
                @endphp

                @foreach ($cart as $item)
                @php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
                @endphp

                <div class="mb-4 border-b border-[#f0e5dc] pb-4">
                    <p class="font-semibold">{{ $item['name'] }}</p>

                    <p class="mt-1 text-sm text-[#806d61]">
                        {{ $item['quantity'] }} x
                        Rp{{ number_format($item['price'], 0, ',', '.') }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-[#805039]">
                        Rp{{ number_format($subtotal, 0, ',', '.') }}
                    </p>
                </div>
                @endforeach

                <div class="flex justify-between pt-2">
                    <span class="font-semibold">Total Pembayaran</span>
                    <span class="font-bold text-[#805039]">
                        Rp{{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>

            </div>
        </div>
    </main>

</body>

</html>