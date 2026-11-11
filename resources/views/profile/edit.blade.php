<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fffaf5;
            color: #49352b;
        }

        .navbar {
            background: #fff;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(73, 53, 43, .08);
        }

        .logo {
            font-size: 23px;
            font-weight: bold;
            color: #49352b;
            text-decoration: none;
        }

        .logo span {
            color: #c98f69;
        }

        .navbar a {
            color: #49352b;
            text-decoration: none;
            margin-left: 22px;
        }

        .container {
            max-width: 1000px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .page-title {
            margin-bottom: 8px;
            font-size: 28px;
            color: #49352b;
        }

        .page-description {
            color: #8b776b;
            margin-bottom: 30px;
        }

        .profile-card {
            background: white;
            border: 1px solid #f0e5dc;
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: 0 3px 12px rgba(73, 53, 43, .04);
        }

        .profile-card h3 {
            color: #75452e;
            margin-top: 0;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 16px 5%;
            }

            .container {
                margin-top: 30px;
            }

            .profile-card {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

    <header class="navbar">
        <a href="/" class="logo">KueKampus<span>.id</span></a>

        <nav>
            <a href="/">Beranda</a>
            <a href="{{ route('produk.index') }}">Produk</a>
            <a href="{{ route('cart.index') }}">Keranjang</a>
        </nav>
    </header>

    <main class="container">
        <h1 class="page-title">Profil Saya</h1>
        <p class="page-description">
            Kelola informasi akun dan keamanan akun KueKampus.id Anda.
        </p>

        <section class="profile-card">
            <h3>Informasi Profil</h3>
            @include('profile.partials.update-profile-information-form')
        </section>

        <section class="profile-card">
            <h3>Ubah Password</h3>
            @include('profile.partials.update-password-form')
        </section>

        <section class="profile-card">
            <h3>Hapus Akun</h3>
            @include('profile.partials.delete-user-form')
        </section>
    </main>

</body>
</html>
