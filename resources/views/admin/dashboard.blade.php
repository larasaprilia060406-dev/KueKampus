
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-amber-50">
    <header class="bg-amber-900 px-6 py-4 text-white">
        <h1 class="text-xl font-bold">KueKampus.id — Admin</h1>
    </header>

    <main class="mx-auto max-w-5xl p-8">
        <h2 class="text-2xl font-bold text-amber-950">
            Selamat Datang, Admin!
        </h2>

        <p class="mt-2 text-gray-600">
            Kamu berhasil masuk ke dashboard administrator KueKampus.id.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('products.index') }}"
               class="rounded-lg bg-amber-800 px-5 py-3 text-white">
                Kelola Produk
            </a>

            <a href="{{ route('categories.index') }}"
               class="rounded-lg bg-amber-700 px-5 py-3 text-white">
                Kelola Kategori
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded-lg bg-gray-800 px-5 py-3 text-white">
                    Logout
                </button>
            </form>
        </div>
    </main>
</body>
</html>
