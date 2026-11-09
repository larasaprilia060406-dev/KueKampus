<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kategori | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fffaf5] text-[#49352b]">

    <header class="border-b border-[#eee4d8] bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a href="/" class="text-2xl font-bold text-[#603d2b]">
                KueKampus<span class="text-[#b87543]">.id</span>
            </a>

            <nav class="flex items-center gap-6 text-sm font-medium">
                <a href="/" class="hover:text-[#b87543]">Beranda</a>
                <a href="{{ route('kategori.index') }}" class="font-semibold text-[#b87543]">Kategori</a>
                <a href="{{ route('produk.index') }}" class="hover:text-[#b87543]">Produk</a>
                <a href="/#tentang" class="hover:text-[#b87543]">Tentang Kami</a>
            </nav>
        </div>
    </header>

    <section class="bg-[#f7e8dc] px-6 py-14">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-semibold uppercase tracking-widest text-[#a36d49]">
                KueKampus.id
            </p>

            <h1 class="mt-3 text-3xl font-bold md:text-4xl">
                Kategori Produk
            </h1>

            <p class="mt-4 max-w-2xl text-sm leading-7 text-[#76533d]">
                Jelajahi berbagai kategori kue dan makanan rumahan
                untuk menemukan pilihan favoritmu.
            </p>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-6 py-12">

        <div class="mb-8">
            <h2 class="text-2xl font-bold">Semua Kategori</h2>
            <p class="mt-2 text-sm text-[#8b7464]">
                Terdapat {{ $categories->count() }} kategori produk.
            </p>
        </div>

        @if ($categories->isEmpty())
        <div class="rounded-xl border border-[#eee0d3] bg-white px-6 py-16 text-center">
            <h3 class="text-lg font-semibold">Belum Ada Kategori</h3>
            <p class="mt-2 text-sm text-gray-500">
                Kategori produk akan ditampilkan di sini.
            </p>
        </div>
        @else
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px;">

            @foreach ($categories as $category)
            <div class="flex h-full flex-col rounded-xl border border-[#eee4d8] bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                <p class="text-xs font-semibold uppercase tracking-wider text-[#b87543]">
                    Kategori KueKampus
                </p>

                <h3 class="mt-3 text-xl font-bold">
                    {{ $category->name }}
                </h3>

                <p class="mt-3 flex-grow text-sm leading-6 text-[#8b7464]">
                    {{ $category->description ?? 'Jelajahi pilihan produk dalam kategori ini.' }}
                </p>

                <a href="{{ route('produk.kategori', $category->id) }}"
                    class="mt-5 flex h-11 w-full items-center justify-center rounded-lg bg-[#80523a] text-sm font-semibold text-white transition hover:bg-[#603d2b]">
                    Lihat Produk
                </a>

            </div>
            @endforeach

        </div>
        @endif

    </main>

    <footer class="mt-10 border-t border-[#eee4d8] bg-white px-6 py-6 text-center text-xs text-gray-500">
        © {{ date('Y') }} KueKampus.id. Semua hak dilindungi.
    </footer>

</body>

</html>