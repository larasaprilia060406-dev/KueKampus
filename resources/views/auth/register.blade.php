<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#faf7f2] text-[#39291f]">

    <main class="flex min-h-screen flex-col">
        <header class="border-b border-[#eee4d8] bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 md:px-10">
                <a href="/" class="text-2xl font-bold tracking-tight text-[#603d2b]">
                    KueKampus<span class="text-[#b87543]">.id</span>
                </a>

                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-[#76533d] hover:text-[#b87543]">
                    Sudah punya akun? <span class="font-semibold">Masuk</span>
                </a>
            </div>
        </header>

        <section class="flex flex-1 items-center justify-center px-5 py-10 sm:px-8 md:py-14">
            <div class="grid w-full max-w-5xl overflow-hidden rounded-2xl border border-[#eee4d8] bg-white shadow-sm md:grid-cols-2">

                <div class="hidden flex-col justify-between bg-[#603d2b] p-10 text-white md:flex lg:p-14">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#e8c7a7]">
                            KueKampus.id
                        </p>

                        <h1 class="mt-8 text-4xl font-semibold leading-tight">
                            Satu langkah menuju kue favoritmu.
                        </h1>

                        <p class="mt-5 max-w-sm text-base leading-7 text-[#f0dfd1]">
                            Buat akun untuk menikmati kemudahan menemukan
                            dan memesan aneka kue rumahan.
                        </p>
                    </div>

                    <p class="mt-12 text-sm text-[#e8c7a7]">
                        Pilihan manis untuk setiap momen.
                    </p>
                </div>

                <div class="px-6 py-9 sm:px-10 sm:py-10 lg:px-12 lg:py-12">
                    <div class="mb-7">
                        <p class="text-sm font-semibold uppercase tracking-wider text-[#b87543]">
                            Bergabung bersama kami
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-[#39291f]">
                            Buat akun baru
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-gray-500">
                            Isi data berikut untuk mulai berbelanja.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold">
                                Nama lengkap
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap"
                                class="w-full rounded-lg border border-[#dfd4c8] px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#9b6846] focus:ring-2 focus:ring-[#9b6846]/20"
                            >

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold">
                                Alamat email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                placeholder="nama@email.com"
                                class="w-full rounded-lg border border-[#dfd4c8] px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#9b6846] focus:ring-2 focus:ring-[#9b6846]/20"
                            >

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold">
                                Password
                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Buat password"
                                class="w-full rounded-lg border border-[#dfd4c8] px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#9b6846] focus:ring-2 focus:ring-[#9b6846]/20"
                            >

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-semibold">
                                Konfirmasi password
                            </label>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi password"
                                class="w-full rounded-lg border border-[#dfd4c8] px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#9b6846] focus:ring-2 focus:ring-[#9b6846]/20"
                            >

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-lg bg-[#603d2b] px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-[#4b2f21] focus:outline-none focus:ring-2 focus:ring-[#9b6846] focus:ring-offset-2"
                        >
                            Daftar Sekarang
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-gray-500">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}"
                           class="font-semibold text-[#8a5b3d] hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>
        </section>

        <footer class="border-t border-[#eee4d8] bg-white px-6 py-5 text-center text-xs text-gray-500">
            © {{ date('Y') }} KueKampus.id. Semua hak dilindungi.
        </footer>
    </main>
</body>
</html>
