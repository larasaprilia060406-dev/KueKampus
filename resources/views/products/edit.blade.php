
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | KueKampus.id</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #fffaf5;
            color: #49352b;
            line-height: 1.6;
        }

        header {
            background: #ffffff;
            border-bottom: 1px solid #eadfd5;
            padding: 18px 7%;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            color: #49352b;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .logo-dot {
            color: #c98f69;
        }

        nav {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 22px;
        }

        nav a {
            color: #49352b;
            text-decoration: none;
            font-size: 14px;
        }

        nav a:hover,
        nav a.active {
            color: #a66542;
        }

        .page-heading {
            background: #f8e8dc;
            padding: 30px 7%;
        }

        .page-heading h1 {
            font-size: 30px;
            margin-bottom: 5px;
        }

        .page-heading p {
            color: #70594b;
            font-size: 15px;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
            padding: 32px 24px 55px;
        }

        .back-link {
            display: inline-block;
            color: #805039;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .form-card {
            background: #ffffff;
            border: 1px solid #eadfd5;
            border-radius: 10px;
            padding: 28px;
        }

        .form-card h2 {
            font-size: 21px;
            margin-bottom: 5px;
        }

        .form-description {
            color: #806d61;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 7px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #ddcfc3;
            border-radius: 5px;
            background: #ffffff;
            color: #49352b;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #b7805d;
            box-shadow: 0 0 0 2px rgba(183, 128, 93, 0.12);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .help-text {
            display: block;
            color: #806d61;
            font-size: 12px;
            margin-top: 6px;
        }

        .current-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 1px solid #eadfd5;
            border-radius: 7px;
            display: block;
            margin-bottom: 12px;
        }

        .no-image {
            width: 150px;
            height: 100px;
            background: #f3e5d9;
            color: #806d61;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 13px;
        }

        .alert-error {
            background: #fbe9e6;
            border: 1px solid #edc9c2;
            color: #923e32;
            padding: 13px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            border-top: 1px solid #f0e5dc;
            padding-top: 22px;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            border: none;
            border-radius: 5px;
            font-family: inherit;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
        }

        .btn-save {
            background: #805039;
            color: #ffffff;
        }

        .btn-save:hover {
            background: #65402e;
        }

        .btn-cancel {
            background: #f3e5d9;
            color: #65402e;
        }

        .btn-cancel:hover {
            background: #ead7c7;
        }

        footer {
            background: #49352b;
            color: #ffffff;
            text-align: center;
            padding: 22px 7%;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            header {
                padding: 16px 5%;
            }

            .navbar {
                align-items: flex-start;
                flex-direction: column;
            }

            nav {
                gap: 14px;
            }

            .page-heading {
                padding: 25px 5%;
            }

            .page-heading h1 {
                font-size: 25px;
            }

            .container {
                padding: 24px 16px 40px;
            }

            .form-card {
                padding: 20px 16px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="navbar">
            <a href="/" class="logo">
                KueKampus<span class="logo-dot">.id</span>
            </a>

            <nav>
                <a href="/">Beranda</a>
                <a href="/produk">Produk</a>
                <a href="/kategori">Kategori</a>
                <a href="/tentang-kami">Tentang Kami</a>
                <a href="{{ route('products.index') }}" class="active">
                    Manajemen Produk
                </a>
            </nav>
        </div>
    </header>

    <section class="page-heading">
        <h1>Edit Produk</h1>
        <p>Perbarui informasi produk KueKampus.id.</p>
    </section>

    <main class="container">

        <a href="{{ route('products.index') }}" class="back-link">
            &larr; Kembali ke Manajemen Produk
        </a>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Periksa kembali data berikut:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <h2>Informasi Produk</h2>
            <p class="form-description">
                Ubah data produk pada formulir di bawah ini.
            </p>

            <form
                action="{{ route('products.update', $product->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" required>
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
                </div>

                <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        min="0"
                        step="1"
                        value="{{ old('price', $product->price) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        min="0"
                        value="{{ old('stock', $product->stock) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Produk</label>
                    <textarea
                        id="description"
                        name="description"
                    >{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Gambar Produk Saat Ini</label>

                    @if ($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="current-image"
                        >
                    @else
                        <div class="no-image">Belum ada gambar</div>
                    @endif

                    <label for="image">Ganti Gambar (Opsional)</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                    >
                    <span class="help-text">
                        Pilih gambar baru jika ingin mengganti gambar produk.
                        Kosongkan jika tidak ingin menggantinya.
                    </span>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-save">
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('products.index') }}"
                        class="btn btn-cancel"
                    >
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} KueKampus.id. Mendukung UMKM makanan rumahan.</p>
    </footer>

</body>
</html>
