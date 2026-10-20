<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk | KueKampus.id</title>

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
            padding: 35px 7%;
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
            padding: 35px 7% 60px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 22px;
        }

        .total-info {
            color: #806d61;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 5px;
            border: none;
            text-decoration: none;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
        }

        .btn-add {
            background: #805039;
            color: #ffffff;
        }

        .btn-add:hover {
            background: #65402e;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .alert-success {
            background: #e8f4e8;
            border: 1px solid #c8e2c8;
            color: #28633a;
        }

        .alert-error {
            background: #fbe9e6;
            border: 1px solid #edc9c2;
            color: #923e32;
        }

        .table-wrapper {
            background: #ffffff;
            border: 1px solid #eadfd5;
            border-radius: 8px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 950px;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: #f8e8dc;
        }

        th {
            color: #49352b;
            font-size: 13px;
            font-weight: bold;
            padding: 15px 12px;
            border-bottom: 1px solid #eadfd5;
            white-space: nowrap;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #f0e5dc;
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #fffdfb;
        }

        .product-image {
            width: 75px;
            height: 75px;
            object-fit: cover;
            border-radius: 6px;
            display: block;
            border: 1px solid #eadfd5;
        }

        .no-image {
            display: flex;
            width: 75px;
            height: 75px;
            align-items: center;
            justify-content: center;
            background: #f3e5d9;
            color: #806d61;
            border-radius: 6px;
            font-size: 11px;
            text-align: center;
            padding: 4px;
        }

        .product-name {
            font-weight: bold;
            color: #49352b;
            min-width: 140px;
        }

        .category-label {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            background: #f8e8dc;
            color: #805039;
            font-size: 12px;
            white-space: nowrap;
        }

        .price {
            color: #805039;
            font-weight: bold;
            white-space: nowrap;
        }

        .description {
            min-width: 180px;
            max-width: 300px;
            color: #70594b;
            overflow-wrap: anywhere;
        }


        .actions {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .actions form {
            margin: 0;
            width: 72px;
        }

        .actions .btn-edit,
        .actions .btn-delete {
            display: inline-flex;
            width: 72px;
            height: 44px;
            padding: 0;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            border: none;
            border-radius: 5px;
            font-family: inherit;
            font-size: 14px;
            line-height: 1;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }


        .btn-edit {
            background: #f8e8dc;
            color: #805039;
        }

        .btn-edit:hover {
            background: #efd4c0;
        }

        .btn-delete {
            background: #fbe9e6;
            color: #923e32;
        }

        .btn-delete:hover {
            background: #f3d3cc;
        }

        .empty-state {
            text-align: center;
            padding: 35px 20px;
            color: #806d61;
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
                padding: 28px 5%;
            }

            .page-heading h1 {
                font-size: 25px;
            }

            .container {
                padding: 25px 5% 40px;
            }

            .toolbar {
                align-items: flex-start;
                flex-direction: column;
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
        <h1>Manajemen Produk</h1>
        <p>Kelola katalog kue dan makanan rumahan KueKampus.id.</p>
    </section>

    <main class="container">

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-error">
            <strong>Periksa kembali data berikut:</strong>
            <ul style="margin: 8px 0 0 20px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="toolbar">
            <p class="total-info">
                Total {{ $products->count() }} produk terdaftar
            </p>

            <a href="{{ route('products.create') }}" class="btn btn-add">
                + Tambah Produk
            </a>
        </div>

        <div class="table-wrapper">
            <table>
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
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if ($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="product-image">
                            @else
                            <div class="no-image">
                                Gambar belum tersedia
                            </div>
                            @endif
                        </td>

                        <td class="product-name">
                            {{ $product->name }}
                        </td>

                        <td>
                            <span class="category-label">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>

                        <td class="price">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>{{ $product->stock }}</td>

                        <td class="description">
                            {{ $product->description ?? '-' }}
                        </td>

                        <td>
                            <div class="actions">
                                <a
                                    href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-edit">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('products.destroy', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            Belum ada produk yang terdaftar.
                            Klik tombol Tambah Produk untuk menambahkan produk baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

    <footer>
        <p>&copy; {{ date('Y') }} KueKampus.id. Mendukung UMKM makanan rumahan.</p>
    </footer>

</body>

</html>