<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-5">
    @csrf
    @method('patch')

    <div>
        <label for="name" class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Nombre</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600">
        @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Correo electrónico</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600">
        @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 text-sm bg-mustard-500/10 text-mustard-600 px-3 py-2 rounded-lg">
                Tu correo no está verificado.
                <button form="send-verification" class="underline hover:no-underline font-medium">
                    Reenviar correo de verificación
                </button>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-1 font-medium text-forest-700 dark:text-forest-500">
                        Se envió un nuevo enlace de verificación a tu correo.
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="flex items-center gap-4">
        <button type="submit" class="bg-forest-600 text-white px-6 py-2.5 rounded-full hover:bg-forest-700 transition-colors font-medium text-sm">
            Guardar cambios
        </button>

        @if (session('status') === 'profile-updated')
            <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="text-sm text-forest-600 font-medium">
                Guardado.
            </span>
        @endif
    </div>
</form>