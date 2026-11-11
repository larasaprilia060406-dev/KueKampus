<section>
    <header>
        <h2 class="text-lg font-semibold" style="color: #75452e;">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm" style="color: #8b776b;">
            Perbarui nama dan alamat email yang digunakan pada akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium mb-2" style="color: #49352b;">
                Nama Lengkap
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="w-full rounded-lg border px-4 py-3 text-sm focus:outline-none focus:ring-2"
                style="border-color: #e5d5c8; color: #49352b;"
            >

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium mb-2" style="color: #49352b;">
                Alamat Email
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="w-full rounded-lg border px-4 py-3 text-sm focus:outline-none focus:ring-2"
                style="border-color: #e5d5c8; color: #49352b;"
            >

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-sm" style="color: #8b776b;">
                        Alamat email Anda belum diverifikasi.

                        <button form="send-verification"
                            class="underline font-medium"
                            style="color: #75452e;">
                            Kirim ulang email verifikasi
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-700">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-6 py-3 rounded-lg text-sm font-semibold text-white transition hover:opacity-90"
                style="background-color: #75452e;">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-700"
                >
                    Perubahan berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>
