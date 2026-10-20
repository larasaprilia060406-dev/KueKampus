
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Produk | KueKampus.id</title>

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
            padding: 45px 7%;
        }

        .page-heading h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: #70594b;
            font-size: 15px;
        }

        .container {
            padding: 40px 7% 60px;
        }

        .catalog-info {
            margin-bottom: 25px;
            color: #806d61;
            font-size: 14px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
            align-items: stretch;
        }

        .product-card {
            background: #ffffff;
            border: 1px solid #eadfd5;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }

        .product-card:hover {
            box-shadow: 0 5px 15px rgba(73, 53, 43, 0.10);
            transform: translateY(-3px);
        }

        .product-card img,
        .product-no-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            background: #f3e5d9;
        }

        .product-no-image {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #806d61;
            font-size: 13px;
        }

        .product-info {
            padding: 17px;
        }

        .product-info h2 {
            font-size: 17px;
            line-height: 1.4;
            margin-bottom: 7px;
            color: #49352b;
        }

        .product-category {
            color: #806d61;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .product-price {
            color: #805039;
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .product-stock {
            color: #806d61;
            font-size: 13px;
            border-top: 1px solid #f0e5dc;
            padding-top: 10px;
        }

        .empty-state {
            background: #ffffff;
            border: 1px solid #eadfd5;
            border-radius: 8px;
            padding: 35px 20px;
            text-align: center;
            color: #806d61;
        }

        footer {
            background: #49352b;
            color: #ffffff;
            text-align: center;
            padding: 22px 7%;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }
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
                padding: 32px 5%;
            }

            .page-heading h1 {
                font-size: 25px;
            }

            .container {
                padding: 30px 5% 45px;
            }

            .products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .product-card img,
            .product-no-image {
                height: 150px;
            }

            .product-info {
                padding: 12px;
            }

            .product-info h2 {
                font-size: 15px;
            }

            .product-price {
                font-size: 15px;
            }
        }

        @media (max-width: 360px) {
            .products-grid {
                grid-template-columns: 1fr;
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
                <a href="/produk" class="active">Produk</a>
                <a href="/kategori">Kategori</a>
                <a href="/tentang-kami">Tentang Kami</a>
                <a href="{{ route('products.index') }}">Manajemen Produk</a>
            </nav>
        </div>
    </header>

    <section class="page-heading">
        <h1>Semua Produk</h1>
        <p>Temukan kue dan makanan rumahan favoritmu di KueKampus.id.</p>
    </section>

    <main class="container">
        <p class="catalog-info">
            Menampilkan {{ $products->count() }} produk
        </p>

        <div class="products-grid">
            @forelse ($products as $product)
                <article class="product-card">
                    @if ($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                        >
                    @else
                        <div class="product-no-image">
                            Gambar belum tersedia
                        </div>
                    @endif

                    <div class="product-info">
                        <h2>{{ $product->name }}</h2>

                        <p class="product-category">
                            {{ $product->category->name ?? 'Tanpa kategori' }}
                        </p>

                        <p class="product-price">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <p class="product-stock">
                            Stok: {{ $product->stock }}
                        </p>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    Belum ada produk yang tersedia saat ini.
                </div>
            @endforelse
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} KueKampus.id. Mendukung UMKM makanan rumahan.</p>
    </footer>

</body>
</html>
