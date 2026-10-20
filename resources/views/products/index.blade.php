<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk | KueKampus.id</title>
</head>

<body>

    <h1>Manajemen Produk</h1>

    <a href="{{ route('products.create') }}">+ Tambah Produk</a>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    {{-- Pesan error --}}
    @if (session('error'))
        <p style="color: red;">
            {{ session('error') }}
        </p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($products as $product)
                <tr>
                    {{-- Nomor urut --}}
                    <td>{{ $loop->iteration }}</td>

                    {{-- Gambar produk --}}
                    <td>
                        @if ($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                width="100"
                                height="100"
                                style="object-fit: cover;"
                            >
                        @else
                            Belum ada gambar
                        @endif
                    </td>

                    {{-- Informasi produk --}}
                    <td>{{ $product->name }}</td>

                    <td>{{ $product->category->name ?? '-' }}</td>

                    <td>
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td>{{ $product->stock }}</td>

                    <td>{{ $product->description ?? '-' }}</td>

                    {{-- Tombol aksi --}}
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">
                            Edit
                        </a>

                        <br><br>

                        <form
                            action="{{ route('products.destroy', $product->id) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">
                        Belum ada produk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>