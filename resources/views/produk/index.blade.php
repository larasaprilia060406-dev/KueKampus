<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fffaf5] text-[#49352b]">

    <!-- Header -->
    <header class="border-b border-[#eee4d8] bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a href="/" class="text-2xl font-bold text-[#603d2b]">
                KueKampus<span class="text-[#b87543]">.id</span>
            </a>

            <nav class="flex items-center gap-6 text-sm font-medium">
                <a href="/" class="hover:text-[#b87543]">Beranda</a>
                <a href="{{ route('kategori.index') }}" class="hover:text-[#b87543]">Kategori</a>
                <a href="{{ route('produk.index') }}" class="font-semibold text-[#b87543]">Produk</a>
                <a href="/#tentang" class="hover:text-[#b87543]">Tentang Kami</a>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-[#f7e8dc] px-6 py-14">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-semibold uppercase tracking-widest text-[#a36d49]">
                KueKampus.id
            </p>

            <h1 class="mt-3 text-3xl font-bold md:text-4xl">
                {{ isset($category) ? 'Produk ' . $category->name : 'Katalog Produk' }}
            </h1>

            <p class="mt-4 max-w-2xl text-sm leading-7 text-[#76533d]">
                Temukan berbagai pilihan kue dan makanan rumahan
                yang cocok untuk menemani setiap momenmu.
            </p>
        </div>
    </section>

    <!-- Daftar Produk -->
    <main class="mx-auto max-w-7xl px-6 py-12">

        <div class="mb-8">
            <h2 class="text-2xl font-bold">
                {{ isset($category) ? 'Produk Kategori ' . $category->name : 'Semua Produk' }}
            </h2>
            <p class="mt-2 text-sm text-[#8b7464]">
                Temukan pilihan produk favoritmu.
            </p>
            @if (isset($category))
            <a href="{{ route('produk.index') }}"
                class="mt-4 inline-block text-sm font-semibold text-[#8a5b3d] hover:underline">
                ← Lihat Semua Produk
            </a>
            @endif
        </div>

        @if ($products->isEmpty())
        <div class="rounded-xl border border-[#eee0d3] bg-white px-6 py-16 text-center">
            <h3 class="text-lg font-semibold">Belum Ada Produk</h3>
            <p class="mt-2 text-sm text-gray-500">
                Produk akan ditampilkan di sini setelah tersedia.
            </p>
        </div>
        @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px; align-items: stretch;">

            @foreach ($products as $product)
            <div class="flex h-full flex-col overflow-hidden rounded-xl border border-[#eee4d8] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                <!-- Gambar Produk -->
                <div style="width: 100%; height: 160px; overflow: hidden; background: #f7e8dc;">
                    @if ($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    @else
                    <div class="flex h-full items-center justify-center text-sm text-[#9b806c]">
                        Gambar belum tersedia
                    </div>
                    @endif
                </div>

                <!-- Informasi Produk -->
                <div class="flex flex-1 flex-col p-5">

                    <p class="text-xs font-medium uppercase tracking-wide text-[#b87543]">
                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                    </p>

                    <h3 class="mt-2 h-14 overflow-hidden text-lg font-semibold leading-7">
                        {{ $product->name }}
                    </h3>

                    <p class="mt-2 h-[72px] overflow-hidden text-sm leading-6 text-[#8b7464]">
                        {{ $product->description ?? 'Belum ada deskripsi produk.' }}
                    </p>

                    <!-- Harga dan Stok -->
                    <div class="mt-auto flex items-center justify-between border-t border-[#eee4d8] pt-4">
                        <p class="text-lg font-bold text-[#80523a]">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <span class="text-xs text-[#8b7464]">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>

                </div>
            </div>
            @endforeach


        </div>
        @endif

    </main>

    <!-- Footer -->
    <footer class="border-t border-[#eee4d8] bg-white px-6 py-6 text-center text-xs text-gray-500">
        © {{ date('Y') }} KueKampus.id. Semua hak dilindungi.
    </footer>

</body>

</html>