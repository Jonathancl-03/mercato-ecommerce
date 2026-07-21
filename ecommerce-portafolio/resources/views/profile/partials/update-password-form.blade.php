<form method="post" action="{{ route('password.update') }}" class="space-y-5">
    @csrf
    @method('put')

    <div>
        <label for="update_password_current_password" class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Contraseña actual</label>
        <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600">
        @error('current_password', 'updatePassword')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="update_password_password" class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Nueva contraseña</label>
        <input id="update_password_password" name="password" type="password" autocomplete="new-password"
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600">
        @error('password', 'updatePassword')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="update_password_password_confirmation" class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Confirmar contraseña</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600">
        @error('password_confirmation', 'updatePassword')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <button type="submit" class="bg-mustard-500 text-white px-6 py-2.5 rounded-full hover:opacity-90 transition-opacity font-medium text-sm">
            Actualizar contraseña
        </button>

        @if (session('status') === 'password-updated')
            <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="text-sm text-forest-600 font-medium">
                Guardado.
            </span>
        @endif
    </div>
</form>