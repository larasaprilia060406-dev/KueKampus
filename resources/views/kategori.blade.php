<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Produk | KueKampus.id</title>

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
            max-width: 1440px;
            margin: 0 auto;
            padding: 35px 7% 55px;
        }


        .category-count {
            color: #806d61;
            font-size: 14px;
            margin-bottom: 25px;
        }


        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            align-items: stretch;
        }

        .category-card {
            background: #ffffff;
            border: 1px solid #eadfd5;
            border-radius: 10px;
            padding: 28px;
            min-height: 190px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }

        .category-card:hover {
            box-shadow: 0 8px 22px rgba(73, 53, 43, 0.10);
            transform: translateY(-3px);
        }

        .category-card h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #49352b;
        }



        .category-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8e8dc;
            border: 1px solid #ead5c4;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        .category-icon svg {
            width: 29px;
            height: 29px;
            color: #805039;
        }

        .category-card {
            background: linear-gradient(145deg, #ffffff, #fff8f1);
            border: 1px solid #eadfd5;
            border-radius: 12px;
            padding: 28px;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }

        .category-card:hover {
            box-shadow: 0 8px 22px rgba(73, 53, 43, 0.12);
            transform: translateY(-4px);
        }

        .category-total {
            display: inline-block;
            background: #f8e8dc;
            color: #805039;
            border-radius: 6px;
            padding: 7px 12px;
            font-size: 12px;
            font-weight: 600;
        }


        .category-card p {
            color: #806d61;
            font-size: 14px;
            margin-bottom: 18px;
            flex-grow: 1;
        }

        .category-total {
            display: inline-block;
            background: #f8e8dc;
            color: #805039;
            border-radius: 5px;
            padding: 6px 11px;
            font-size: 12px;
            font-weight: 600;
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

        @media (max-width: 800px) {
            .category-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .category-card {
                min-height: 165px;
                padding: 22px;
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

            .category-grid {
                grid-template-columns: 1fr;
                gap: 15px;
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
                <a href="/kategori" class="active">Kategori</a>
                <a href="/tentang-kami">Tentang Kami</a>
                <a href="{{ route('products.index') }}">Manajemen Produk</a>
            </nav>
        </div>
    </header>

    <section class="page-heading">
        <h1>Kategori Produk</h1>
        <p>Lihat kategori kue dan makanan rumahan yang tersedia di KueKampus.id.</p>
    </section>

    <main class="container">
        <p class="category-count">
            Terdapat {{ $categories->count() }} kategori produk
        </p>

        <div class="category-grid">
            @forelse ($categories as $category)

            <article class="category-card">
                <div class="category-icon">
                    <svg viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path d="M5 13L16 5L27 13"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M8 13H24L22 25H10L8 13Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linejoin="round" />
                        <path d="M12 17V21M16 17V21M20 17V21"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                </div>

                <h2>{{ $category->name }}</h2>

                <p>
                    {{ $category->description ?: 'Lihat pilihan produk dari kategori ini.' }}
                </p>

                <span class="category-total">
                    {{ $category->products_count }}
                    {{ $category->products_count == 1 ? 'produk' : 'produk' }}
                </span>
            </article>
            @empty
            <div class="empty-state">
                Belum ada kategori yang tersedia.
            </div>
            @endforelse
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} KueKampus.id. Mendukung UMKM makanan rumahan.</p>
    </footer>

</body>

</html>