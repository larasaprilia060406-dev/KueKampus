
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | KueKampus.id</title>

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
            line-height: 1.7;
        }

        header {
            background: #fff;
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
            max-width: 1100px;
            margin: 0 auto;
            padding: 45px 30px 60px;
        }

        .about-section {
            background: #fff;
            border: 1px solid #eadfd5;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 25px;
        }

        .about-section h2 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .about-section p {
            color: #70594b;
            margin-bottom: 12px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .value-card {
            background: #f8e8dc;
            border-radius: 8px;
            padding: 22px;
        }

        .value-card h3 {
            font-size: 17px;
            margin-bottom: 8px;
        }

        .value-card p {
            font-size: 14px;
            margin-bottom: 0;
        }

        .contact-section {
            background: #49352b;
            color: #fff;
            border-radius: 8px;
            padding: 30px;
        }

        .contact-section h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .contact-section p {
            color: #f5e7dc;
            margin-bottom: 18px;
        }

        .contact-button {
            display: inline-block;
            background: #f3d7c0;
            color: #49352b;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        .contact-button:hover {
            background: #fff;
        }

        footer {
            background: #49352b;
            color: #fff;
            text-align: center;
            padding: 22px 7%;
            font-size: 13px;
        }

        @media (max-width: 700px) {
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

            .about-section,
            .contact-section {
                padding: 22px;
            }

            .values-grid {
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
                <a href="/produk">Produk</a>
                <a href="/kategori">Kategori</a>
                <a href="/tentang-kami" class="active">Tentang Kami</a>
                <a href="{{ route('products.index') }}">Manajemen Produk</a>
            </nav>
        </div>
    </header>

    <section class="page-heading">
        <h1>Tentang KueKampus.id</h1>
        <p>Mengenal lebih dekat platform produk makanan rumahan kami.</p>
    </section>

    <main class="container">

        <section class="about-section">
            <h2>Siapa Kami?</h2>

            <p>
                KueKampus.id merupakan platform e-commerce yang dirancang
                untuk membantu pelanggan menemukan berbagai pilihan kue
                dan makanan rumahan dengan lebih mudah.
            </p>

            <p>
                Melalui website ini, pelanggan dapat melihat katalog produk,
                mengetahui harga, serta mengenal kategori makanan yang tersedia.
                Platform ini juga dikembangkan sebagai bagian dari penerapan
                teknologi informasi dalam mendukung kegiatan usaha UMKM makanan rumahan.
            </p>
        </section>

        <section class="about-section">
            <h2>Tujuan Kami</h2>

            <p>
                Kami ingin menghadirkan pengalaman pencarian produk yang
                sederhana, informatif, dan mudah digunakan. KueKampus.id
                dikembangkan agar informasi produk dapat disajikan secara
                lebih terstruktur melalui sebuah platform digital.
            </p>

            <div class="values-grid">
                <div class="value-card">
                    <h3>Mudah Digunakan</h3>
                    <p>
                        Tampilan website sederhana agar pengunjung dapat
                        menemukan informasi produk dengan mudah.
                    </p>
                </div>

                <div class="value-card">
                    <h3>Informasi Jelas</h3>
                    <p>
                        Menampilkan nama produk, kategori, harga, dan stok
                        yang tersedia pada katalog.
                    </p>
                </div>

                <div class="value-card">
                    <h3>Mendukung UMKM</h3>
                    <p>
                        Memanfaatkan teknologi digital untuk membantu
                        penyajian informasi produk makanan rumahan.
                    </p>
                </div>
            </div>
        </section>

        <section class="contact-section">
            <h2>Jelajahi Produk Kami</h2>

            <p>
                Temukan berbagai pilihan kue dan makanan rumahan
                melalui katalog KueKampus.id.
            </p>

            <a href="/produk" class="contact-button">
                Lihat Semua Produk
            </a>
        </section>

    </main>

    <footer>
        <p>&copy; {{ date('Y') }} KueKampus.id. Mendukung UMKM makanan rumahan.</p>
    </footer>

</body>
</html>
