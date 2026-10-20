<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | KueKampus.id</title>
</head>

<body>

    <h1>Tambah Produk</h1>

    <a href="{{ route('products.index') }}">← Kembali ke Daftar Produk</a>

    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <p>
            <label>Nama Produk:</label><br>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required>
        </p>

        <p>
            <label>Kategori:</label><br>
            <select name="category_id" required>
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Harga (Rp):</label><br>
            <input
                type="number"
                name="price"
                min="0"
                step="1"
                value="{{ old('price') }}"
                required>
        </p>

        <p>
            <label>Stok:</label><br>
            <input
                type="number"
                name="stock"
                min="0"
                value="{{ old('stock', 0) }}"
                required>
        </p>

        <p>
            <label>Deskripsi:</label><br>
            <textarea name="description" rows="4" cols="40">{{ old('description') }}</textarea>
        </p>

        <p>
            <label>Upload Gambar Produk (opsional):</label><br>
            <input
                type="file"
                name="image"
                id="image"
                accept=".jpg,.jpeg,.png,.webp">

            @error('image')
            <span style="color: red;">{{ $message }}</span>
            @enderror
        </p>

        <button type="submit">Simpan Produk</button>
    </form>

</body>

</html>