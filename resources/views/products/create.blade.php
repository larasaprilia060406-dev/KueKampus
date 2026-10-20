
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | KueKampus.id</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #faf6f0;
            color: #49352a;
        }

        header {
            background: #fffdf9;
            padding: 20px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            border-bottom: 1px solid #eadfd3;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #754c35;
            text-decoration: none;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        nav a {
            color: #634b3c;
            text-decoration: none;
            font-size: 14px;
        }

        nav a:hover {
            color: #a66b45;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .heading {
            margin-bottom: 25px;
        }

        .heading h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .heading p {
            color: #8a7768;
            font-size: 14px;
        }

        .form-card {
            background: #fffdf9;
            padding: 30px;
            border: 1px solid #eadfd3;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(80, 52, 32, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dfd1c3;
            border-radius: 7px;
            background: #fff;
            color: #49352a;
            font-size: 14px;
            font-family: inherit;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #9b6b4c;
            box-shadow: 0 0 0 2px rgba(155, 107, 76, 0.12);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .hint {
            margin-top: 7px;
            color: #8a7768;
            font-size: 12px;
        }

        .error {
            color: #b42318;
            font-size: 13px;
            margin-top: 6px;
        }

        .alert {
            padding: 12px 15px;
            background: #fff0ed;
            color: #a12a20;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 7px;
            border: none;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-cancel {
            background: #f1e8de;
            color: #634b3c;
        }

        .btn-save {
            background: #79543c;
            color: white;
        }

        .btn-save:hover {
            background: #62412e;
        }

        footer {
            text-align: center;
            padding: 25px 15px;
            color: #8a7768;
            font-size: 13px;
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            header {
                padding: 18px 5%;
            }

            nav {
                gap: 12px;
            }

            .container {
                margin-top: 25px;
            }

            .form-card {
                padding: 20px;
            }

            .heading h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<header>
    <a href="{{ url('/') }}" class="logo">KueKampus.id</a>

    <nav>
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ url('/produk') }}">Produk</a>
        <a href="{{ url('/kategori') }}">Kategori</a>
        <a href="{{ url('/tentang-kami') }}">Tentang Kami</a>
        <a href="{{ route('products.index') }}">Manajemen Produk</a>
    </nav>
</header>

<main class="container">
    <div class="heading">
        <h1>Tambah Produk</h1>
        <p>Tambahkan produk makanan rumahan baru ke KueKampus.id.</p>
    </div>

    <div class="form-card">

        @if ($errors->any())
            <div class="alert">
                <strong>Data belum berhasil disimpan.</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nama Produk *</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Brownies Cokelat"
                       required>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Kategori *</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Harga (Rp) *</label>
                <input type="number"
                       id="price"
                       name="price"
                       value="{{ old('price') }}"
                       min="0"
                       step="1"
                       placeholder="Contoh: 25000"
                       required>
                @error('price')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stok Produk *</label>
                <input type="number"
                       id="stock"
                       name="stock"
                       value="{{ old('stock') }}"
                       min="0"
                       step="1"
                       placeholder="Masukkan jumlah stok"
                       required>
                @error('stock')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Produk</label>
                <textarea id="description"
                          name="description"
                          placeholder="Jelaskan rasa, ukuran, bahan, atau keunggulan produk...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Foto Produk</label>
                <input type="file"
                       id="image"
                       name="image"
                       accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                <p class="hint">Format JPG, JPEG, PNG, atau WEBP. Ukuran maksimal 2 MB.</p>
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="actions">
                <a href="{{ route('products.index') }}" class="btn btn-cancel">
                    Batal
                </a>
                <button type="submit" class="btn btn-save">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</main>

<footer>
    © {{ date('Y') }} KueKampus.id Mendukung UMKM makanan rumahan.
</footer>

</body>
</html>
