<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#fffaf5] text-[#49352b]">

    <div class="max-w-3xl mx-auto px-6 py-12">

        <a href="{{ route('produk.index') }}"
            class="text-sm text-[#75452e] hover:underline">
            &larr; Kembali ke Produk
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-[#eee4d8] p-6 md:p-8 mt-6">

            <h1 class="text-2xl font-bold mb-2">Konfirmasi Pembayaran</h1>
            <p class="text-sm text-gray-500 mb-6">
                Periksa kembali pesanan sebelum melanjutkan pembayaran.
            </p>

            @if (session('success'))
            <div class="bg-green-50 text-green-700 p-3 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-50 text-red-700 p-3 rounded-lg mb-4 text-sm">
                {{ session('error') }}
            </div>
            @endif

            <div class="border-b border-[#eee4d8] pb-5 mb-5">
                <p class="text-sm text-gray-500">Nomor Pesanan</p>
                <p class="font-semibold">{{ $order->order_number }}</p>

                <p class="text-sm text-gray-500 mt-3">Alamat Pengiriman</p>
                <p>{{ $order->shipping_address }}</p>
            </div>

            <h2 class="font-semibold mb-4">Detail Pesanan</h2>

            <div class="space-y-4">
                @foreach ($order->orderItems as $item)
                <div class="flex justify-between gap-4 text-sm">
                    <div>
                        <p class="font-medium">
                            {{ $item->product->name ?? 'Produk' }}
                        </p>
                        <p class="text-gray-500">
                            {{ $item->quantity }} x
                            Rp{{ number_format($item->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <p class="font-medium whitespace-nowrap">
                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
                @endforeach
            </div>

            <div class="border-t border-[#eee4d8] mt-6 pt-5 flex justify-between items-center">
                <span class="font-semibold">Total Pembayaran</span>
                <span class="text-xl font-bold text-[#75452e]">
                    Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                </span>
            </div>

            @if ($order->payment_status === 'paid')

            <div class="mt-6 bg-green-50 text-green-700 p-4 rounded-lg text-center">
                Pesanan ini sudah dibayar.
            </div>

            @elseif ($order->payment_status === 'failed')

            <div class="mt-6 bg-red-50 text-red-700 p-4 rounded-lg text-center">
                Pembayaran pesanan ini gagal atau kedaluwarsa.
            </div>

            @else

            <form action="{{ route('orders.pay', $order) }}" method="POST" class="mt-7">
                @csrf

                <button type="submit"
                    class="w-full bg-[#75452e] hover:bg-[#49352b] text-white font-semibold py-3 rounded-xl transition">
                    Bayar Sekarang
                </button>
            </form>

            @endif

        </div>
    </div>

</body>

</html>