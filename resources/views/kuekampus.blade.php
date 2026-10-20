<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KueKampus.id - Kue Rumahan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fffaf5;
            color: #49352b;
            line-height: 1.6;
        }

        header {
            background-color: #ffffff;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f0e5dc;
        }



        .logo {
            display: inline-flex;
            align-items: center;
            color: #49352b;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .logo-dot {
            color: #c98f69;
        }



        nav a {
            text-decoration: none;
            color: #49352b;
            margin-left: 24px;
            font-size: 14px;
        }

        nav a:hover {
            color: #b56b52;
        }

        .hero {
            padding: 75px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            background-color: #f8e8dc;
        }

        .hero-text {
            max-width: 550px;
        }

        .hero-text .label {
            color: #a45d43;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .hero h1 {
            font-size: 42px;
            line-height: 1.25;
            margin-bottom: 18px;
        }

        .hero p {
            font-size: 16px;
            color: #70594d;
            margin-bottom: 28px;
        }

        .btn {
            display: inline-block;
            background-color: #805039;
            color: white;
            padding: 12px 23px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #633c2a;
        }

        .hero-image {
            width: 42%;
            max-width: 430px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        .section {
            padding: 55px 7%;
        }

        .section h2 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .section-desc {
            color: #806d61;
            margin-bottom: 25px;
        }


        .categories {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 14px;
            margin-top: 25px;
        }

        .category {
            background: white;
            border: 1px solid #eadbd0;
            border-radius: 6px;
            padding: 14px 22px;
            color: #654632;
            text-align: center;
        }

        #kategori {
            text-align: center;
        }


        .about {
            background: #ffffff;
            padding: 35px;
            border-radius: 8px;
            border: 1px solid #f0e5dc;
        }

        footer {
            background-color: #49352b;
            color: white;
            text-align: center;
            padding: 22px;
            font-size: 13px;
        }

        @media (max-width: 700px) {
            header {
                flex-direction: column;
                gap: 12px;
            }

            nav {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 12px;
            }

            nav a {
                margin-left: 0;
            }

            .hero {
                flex-direction: column;
                align-items: flex-start;
                padding: 45px 7%;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero-image {
                width: 100%;
                height: 230px;
            }

            .section {
                padding: 40px 7%;
            }
        }



        /* Katalog produk */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
            margin-top: 28px;
            text-align: left;
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

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            background-color: #f3e5d9;
        }

        .product-no-image {
            height: 200px;
            background: #f3e5d9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #806d61;
            font-size: 14px;
        }

        .product-info {
            padding: 17px;
        }

        .product-info h3 {
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

        @media (max-width: 900px) {
            .products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
            }

            .product-card img,
            .product-no-image {
                height: 220px;
            }
        }

        .section-divider {
            width: 100%;
            height: 2px;
            background-color: #e8d8cb;
            margin: 0;
            padding: 0;
            border: 0;
            display: block;
        }
    </style>
</head>

<body>

    <header>

        <a href="/" class="logo">
            <span>KueKampus<span class="logo-dot">.id</span></span>
        </a>


        <nav>
            <a href="/">Beranda</a>
            <a href="{{ url('/kategori') }}">Kategori</a>
            <a href="/produk">Produk</a>
            <a href="#tentang">Tentang Kami</a>
            <a href="/products">Manajemen Produk</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <p class="label">KUE RUMAHAN, DIBUAT DENGAN SEPENUH HATI</p>

            <h1>Temukan Kue Favoritmu di KueKampus.id</h1>

            <p>
                Berbagai pilihan kue dan makanan rumahan untuk menemani
                waktu santai, acara keluarga, hingga kegiatan kampus.
            </p>

            <a href="#kategori" class="btn">Lihat Kategori</a>
        </div>

        <img
            class="hero-image"
            src="https://images.unsplash.com/photo-1550617931-e17a7b70dce2?auto=format&fit=crop&w=1000&q=85"
            alt="Aneka kue dan cupcake">
    </section>

    <section class="section" id="produk">
        <h2>Produk Kami</h2>

        <p class="section-desc">
            Pilihan kue dan makanan rumahan yang tersedia.
        </p>

        <div class="products-grid">
            @forelse ($products as $product)
            <div class="product-card">
                @if ($product->image)
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}">
                @else
                <div class="product-no-image">
                    Gambar belum tersedia
                </div>
                @endif

                <div class="product-info">
                    <h3>{{ $product->name }}</h3>

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
            </div>
            @empty
            <p>Belum ada produk yang tersedia.</p>
            @endforelse
        </div>
    </section>

    <div class="section-divider"></div>

    <section class="section" id="kategori">
        <h2>Kategori Pilihan</h2>

        <p class="section-desc">
            Pilih jenis makanan yang kamu cari.
        </p>

        <div class="categories">
            <div class="category">Kue Basah</div>
            <div class="category">Kue Kering</div>
            <div class="category">Cake &amp; Tart</div>
            <div class="category">Snack Box</div>
            <div class="category">Catering &amp; Nasi Box</div>
        </div>
    </section>

    <section class="section" id="tentang">
        <div class="about">
            <h2>Tentang KueKampus.id</h2>

            <p>
                KueKampus.id merupakan platform e-commerce yang
                dikembangkan untuk membantu UMKM makanan rumahan
                memperkenalkan dan memasarkan produknya secara online.
            </p>
        </div>
    </section>

    <footer>
        &copy; 2026 KueKampus.id. Mendukung UMKM makanan rumahan.
    </footer>

</body>

</html>