<p class="text-sm text-ink-900/60 dark:text-white/50 mb-5">
    Una vez que elimines tu cuenta, todos sus datos se borrarán permanentemente. Antes de continuar, descarga cualquier información que quieras conservar.
</p>

<button type="button" x-data @click="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 text-white px-6 py-2.5 rounded-full hover:bg-red-700 transition-colors font-medium text-sm">
    Eliminar cuenta
</button>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="font-display text-xl font-semibold text-ink-900 dark:text-white mb-2">
            ¿Confirmas que quieres eliminar tu cuenta?
        </h2>

        <p class="text-sm text-ink-900/60 dark:text-white/50 mb-5">
            Esta acción es permanente. Ingresa tu contraseña para confirmar que deseas eliminar tu cuenta.
        </p>

        <div>
            <label for="password" class="sr-only">Contraseña</label>
            <input id="password" name="password" type="password" placeholder="Contraseña"
                   class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-red-500 focus:border-red-500">
            @error('password', 'userDeletion')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <button type="button" x-on:click="$dispatch('close')"
                    class="px-5 py-2.5 rounded-full border border-stone-100 dark:border-white/10 text-ink-900 dark:text-white font-medium text-sm hover:bg-stone-50 dark:hover:bg-white/5 transition-colors">
                Cancelar
            </button>
            <button type="submit" class="px-5 py-2.5 rounded-full bg-red-600 text-white font-medium text-sm hover:bg-red-700 transition-colors">
                Eliminar cuenta
            </button>
        </div>
    </form>
</x-modal>