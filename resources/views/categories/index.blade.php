<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fffaf5] text-[#49352b]">

    <header class="bg-white border-b border-[#eee4d8]">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold text-[#603d2b]">
                KueKampus<span class="text-[#b87543]">.id</span>
            </a>

            <nav class="flex items-center gap-7 text-sm font-medium">
                <a href="/" class="hover:text-[#b87543]">Beranda</a>
                <a href="{{ route('products.index') }}" class="hover:text-[#b87543]">Produk</a>
                <a href="{{ route('categories.index') }}" class="text-[#b87543]">Kategori</a>
                <a href="/#tentang" class="hover:text-[#b87543]">Tentang Kami</a>
            </nav>
        </div>
    </header>

    <section class="bg-[#f7e8dc] py-12">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-sm font-semibold uppercase tracking-wider text-[#a36d49]">
                KueKampus.id
            </p>

            <h1 class="text-3xl font-bold mt-3 text-[#49352b]">
                Manajemen Kategori
            </h1>

            <p class="mt-3 text-[#76533d]">
                Kelola kategori kue dan makanan rumahan KueKampus.id.
            </p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-10">

        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-5 py-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-5 py-4 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-5 py-4 text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
            <div>
                <p class="text-[#76533d]">
                    Total <span class="font-bold text-[#603d2b]">{{ $categories->count() }}</span>
                    kategori terdaftar
                </p>
            </div>

            <a href="{{ route('categories.create') }}"
               class="inline-flex items-center justify-center rounded-lg bg-[#80523a] px-6 py-3 text-sm font-semibold text-white hover:bg-[#603d2b] transition">
                + Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto rounded-xl border border-[#eee0d3] bg-white shadow-sm">
            <table class="w-full min-w-[650px] text-sm">
                <thead class="bg-[#f7e8dc] text-[#49352b]">
                    <tr>
                        <th class="px-5 py-4 text-left font-semibold">No.</th>
                        <th class="px-5 py-4 text-left font-semibold">Nama Kategori</th>
                        <th class="px-5 py-4 text-left font-semibold">Deskripsi</th>
                        <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#f0e5db]">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-[#fffaf5] transition">
                            <td class="px-5 py-5">{{ $loop->iteration }}</td>

                            <td class="px-5 py-5 font-semibold">
                                {{ $category->name }}
                            </td>

                            <td class="px-5 py-5 text-[#765f50]">
                                {{ $category->description ?? '-' }}
                            </td>

                            <td class="px-5 py-5">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="rounded-lg bg-[#f7e8dc] px-4 py-2 font-medium text-[#80523a] hover:bg-[#efdbc9] transition">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg bg-[#fce9e7] px-4 py-2 font-medium text-[#a33b32] hover:bg-[#f8d8d4] transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-gray-500">
                                Belum ada kategori yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

    <footer class="mt-10 border-t border-[#eee4d8] bg-white px-6 py-6 text-center text-xs text-gray-500">
        © {{ date('Y') }} KueKampus.id. Semua hak dilindungi.
    </footer>

</body>
</html>
