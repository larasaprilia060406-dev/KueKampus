<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold" style="color: #75452e;">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm leading-relaxed" style="color: #8b776b;">
            Jika akun dihapus, seluruh data dan informasi akun Anda akan dihapus secara permanen.
            Pastikan Anda sudah menyimpan informasi penting sebelum melanjutkan.
        </p>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-5 py-3 rounded-lg text-sm font-semibold text-white transition hover:opacity-90"
        style="background-color: #b83d32;">
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold" style="color: #49352b;">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-2 text-sm leading-relaxed" style="color: #8b776b;">
                Tindakan ini tidak dapat dibatalkan. Seluruh data akun Anda akan dihapus secara permanen.
                Masukkan password untuk mengonfirmasi penghapusan akun.
            </p>

            <div class="mt-6">
                <label for="password"
                    class="block text-sm font-medium mb-2"
                    style="color: #49352b;">
                    Password Anda
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Masukkan password"
                    class="w-full rounded-lg border px-4 py-3 text-sm focus:outline-none"
                    style="border-color: #e5d5c8; color: #49352b;"
                >

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold border"
                    style="border-color: #e5d5c8; color: #75452e;">
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold text-white"
                    style="background-color: #b83d32;">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
