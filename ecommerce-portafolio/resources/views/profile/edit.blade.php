<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">

        <div class="profile-fade mb-10">
            <span class="text-xs font-semibold uppercase tracking-widest text-forest-600 dark:text-forest-500">Configuración</span>
            <h1 class="font-display text-3xl md:text-4xl font-semibold text-ink-900 dark:text-white mt-2">Mi perfil</h1>
            <p class="text-ink-900/50 dark:text-white/50 mt-2">Gestiona tu información de cuenta y seguridad</p>
        </div>

        <div class="space-y-6">
            <div class="profile-fade rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-forest-600/10 flex items-center justify-center text-forest-600 dark:text-forest-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-ink-900 dark:text-white">Información personal</h2>
                        <p class="text-xs text-ink-900/40 dark:text-white/30">Tu nombre y correo electrónico</p>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="profile-fade rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-mustard-500/10 flex items-center justify-center text-mustard-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-ink-900 dark:text-white">Contraseña</h2>
                        <p class="text-xs text-ink-900/40 dark:text-white/30">Usa una contraseña larga y segura</p>
                    </div>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            <div class="profile-fade rounded-2xl border border-red-200 dark:border-red-500/20 bg-white dark:bg-ink-900 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-red-50 dark:bg-red-500/10 flex items-center justify-center text-red-600 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-ink-900 dark:text-white">Zona de peligro</h2>
                        <p class="text-xs text-ink-900/40 dark:text-white/30">Eliminar tu cuenta es una acción permanente</p>
                    </div>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <style>
        .profile-fade { opacity: 0; transform: translateY(20px); }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;
            gsap.to('.profile-fade', { opacity: 1, y: 0, duration: 0.5, stagger: 0.1, ease: 'power3.out' });
        });
    </script>
</x-app-layout>