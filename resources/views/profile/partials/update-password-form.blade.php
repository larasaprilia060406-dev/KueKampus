<section>
    <header>
        <h2 class="text-lg font-semibold" style="color: #75452e;">
            Ubah Password
        </h2>

        <p class="mt-1 text-sm" style="color: #8b776b;">
            Gunakan password yang kuat untuk menjaga keamanan akun Anda.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password"
                class="block text-sm font-medium mb-2" style="color: #49352b;">
                Password Saat Ini
            </label>

            <input id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full rounded-lg border px-4 py-3 text-sm focus:outline-none focus:ring-2"
                style="border-color: #e5d5c8; color: #49352b;">

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password"
                class="block text-sm font-medium mb-2" style="color: #49352b;">
                Password Baru
            </label>

            <input id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-lg border px-4 py-3 text-sm focus:outline-none focus:ring-2"
                style="border-color: #e5d5c8; color: #49352b;">

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation"
                class="block text-sm font-medium mb-2" style="color: #49352b;">
                Konfirmasi Password Baru
            </label>

            <input id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-lg border px-4 py-3 text-sm focus:outline-none focus:ring-2"
                style="border-color: #e5d5c8; color: #49352b;">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-6 py-3 rounded-lg text-sm font-semibold text-white transition hover:opacity-90"
                style="background-color: #75452e;">
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-700">
                    Password berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>
