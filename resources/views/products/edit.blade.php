<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | KueKampus.id</title>
</head>
<body>

    <h1>Edit Produk</h1>

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

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Nama Produk:</label><br>
            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
                required
            >
        </p>

        <p>
            <label>Kategori:</label><br>
            <select name="category_id" required>
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                    >
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
                value="{{ old('price', $product->price) }}"
                required
            >
        </p>

        <p>
            <label>Stok:</label><br>
            <input
                type="number"
                name="stock"
                min="0"
                value="{{ old('stock', $product->stock) }}"
                required
            >
        </p>

        <p>
            <label>Deskripsi:</label><br>
            <textarea name="description" rows="4" cols="40">{{ old('description', $product->description) }}</textarea>
        </p>

        <p>
            <label>Nama File Gambar (opsional):</label><br>
            <input
                type="text"
                name="image"
                value="{{ old('image', $product->image) }}"
                placeholder="contoh: nastar.jpg"
            >
        </p>

        <button type="submit">Simpan Perubahan</button>
    </form>

</body>
</html>