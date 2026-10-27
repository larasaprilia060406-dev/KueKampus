
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KueKampus.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#faf7f2] text-[#39291f]">

    <main class="flex min-h-screen flex-col">

        <header class="border-b border-[#eee4d8] bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 md:px-10">
                <a href="/" class="text-2xl font-bold tracking-tight text-[#603d2b]">
                    KueKampus<span class="text-[#b87543]">.id</span>
                </a>

                <a href="{{ route('register') }}"
                   class="text-sm font-medium text-[#76533d] transition hover:text-[#b87543]">
                    Belum punya akun? <span class="font-semibold">Daftar</span>
                </a>
            </div>
        </header>

        <section class="flex flex-1 items-center justify-center px-5 py-12 sm:px-8 md:py-16">
            <div class="grid w-full max-w-5xl overflow-hidden rounded-2xl border border-[#eee4d8] bg-white shadow-sm md:grid-cols-2">

                <div class="hidden flex-col justify-between bg-[#603d2b] p-10 text-white md:flex lg:p-14">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#e8c7a7]">
                            KueKampus.id
                        </p>

                        <h1 class="mt-8 text-4xl font-semibold leading-tight">
                            Temukan kue favoritmu, mulai dari sini.
                        </h1>

                        <p class="mt-5 max-w-sm text-base leading-7 text-[#f0dfd1]">
                            Beragam pilihan kue rumahan untuk menemani hari-harimu.
                            Praktis, dekat, dan mudah dipesan.
                        </p>
                    </div>

                    <p class="mt-12 text-sm text-[#e8c7a7]">
                        Pilihan manis untuk setiap momen.
                    </p>
                </div>

                <div class="px-6 py-9 sm:px-10 sm:py-12 lg:px-12 lg:py-14">
                    <div class="mb-8">
                        <p class="text-sm font-semibold uppercase tracking-wider text-[#b87543]">
                            Selamat datang kembali
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-[#39291f]">
                            Masuk ke akun
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-gray-500">
                            Masukkan email dan password untuk melanjutkan.
                        </p>
                    </div>

                    <x-auth-session-status
                        class="mb-5"
                        :status="session('status')"
                    />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-[#39291f]">
                                Alamat email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="nama@email.com"
                                class="w-full rounded-lg border border-[#dfd4c8] bg-white px-4 py-3 text-sm text-[#39291f] outline-none transition placeholder:text-gray-400 focus:border-[#9b6846] focus:ring-2 focus:ring-[#9b6846]/20"
                            >

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <div class="mb-2 flex items-center justify-between gap-3">
                                <label for="password" class="text-sm font-semibold text-[#39291f]">
                                    Password
                                </label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                       class="text-xs font-medium text-[#8a5b3d] hover:underline">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full rounded-lg border border-[#dfd4c8] bg-white px-4 py-3 text-sm text-[#39291f] outline-none transition placeholder:text-gray-400 focus:border-[#9b6846] focus:ring-2 focus:ring-[#9b6846]/20"
                            >

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <label for="remember_me" class="flex cursor-pointer items-center gap-2.5">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="h-4 w-4 rounded border-[#cfc0b2] text-[#76503a] focus:ring-[#9b6846]"
                            >
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>

                        <button
                            type="submit"
                            class="w-full rounded-lg bg-[#603d2b] px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-[#4b2f21] focus:outline-none focus:ring-2 focus:ring-[#9b6846] focus:ring-offset-2"
                        >
                            Masuk
                        </button>
                    </form>

                    <p class="mt-7 text-center text-sm text-gray-500">
                        Belum memiliki akun?
                        <a href="{{ route('register') }}"
                           class="font-semibold text-[#8a5b3d] hover:underline">
                            Daftar sekarang
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
