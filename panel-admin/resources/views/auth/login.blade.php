<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesion - Mercato Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

    <div class="min-h-screen w-full flex items-center justify-center bg-stone-50 p-4">
        <div class="w-full max-w-4xl overflow-hidden rounded-2xl flex bg-white shadow-xl">

            <div class="hidden md:block w-1/2 h-[600px] relative overflow-hidden border-r border-stone-100 bg-gradient-to-br from-forest-600/5 to-mustard-500/10">
                <canvas id="dotMap" class="absolute inset-0 w-full h-full"></canvas>

                <div class="absolute inset-0 flex flex-col items-center justify-center p-8 z-10 text-center">
                    <div class="h-12 w-12 rounded-full bg-forest-600 flex items-center justify-center shadow-lg mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl font-semibold mb-2 text-forest-600">Mercato <span class="text-ink-900/40 text-lg font-sans font-normal">Admin</span></h2>
                    <p class="text-sm text-ink-900/60 max-w-xs">
                        Panel de administración. Inicia sesión para gestionar productos y pedidos.
                    </p>
                </div>
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center bg-white" x-data="{ showPassword: false }">
                <h1 class="font-display text-2xl md:text-3xl font-semibold mb-1">Panel de administración</h1>
                <p class="text-ink-900/50 mb-8">Inicia sesion en tu cuenta de administrador</p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-ink-900 mb-1">Correo electronico</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full border border-stone-100 rounded-lg px-3 py-2.5 bg-stone-50 focus:ring-forest-600 focus:border-forest-600">
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-ink-900 mb-1">Contrasena</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                                class="w-full border border-stone-100 rounded-lg px-3 py-2.5 pr-10 bg-stone-50 focus:ring-forest-600 focus:border-forest-600">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-ink-900/40 hover:text-ink-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-ink-900/70">
                            <input type="checkbox" name="remember" class="rounded border-stone-100 text-forest-600 focus:ring-forest-600">
                            Recordarme
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-forest-600 hover:underline">Olvidaste tu contrasena?</a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full bg-forest-600 hover:bg-forest-700 text-white py-2.5 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                        Iniciar sesion
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>

                    <p class="text-center text-sm text-ink-900/40 mt-4">
                        Acceso restringido solo para administradores
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('dotMap');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            let width, height, dots = [];

            const routes = [
                { start: { x: 0.3, y: 0.55, delay: 0 }, end: { x: 0.6, y: 0.3, delay: 2 } },
                { start: { x: 0.6, y: 0.3, delay: 2 }, end: { x: 0.75, y: 0.5, delay: 4 } },
                { start: { x: 0.15, y: 0.2, delay: 1 }, end: { x: 0.45, y: 0.7, delay: 3 } },
            ];

            function resize() {
                width = canvas.width = canvas.parentElement.clientWidth;
                height = canvas.height = canvas.parentElement.clientHeight;
                generateDots();
            }

            function generateDots() {
                dots = [];
                const gap = 14;
                for (let x = 0; x < width; x += gap) {
                    for (let y = 0; y < height; y += gap) {
                        if (Math.random() > 0.55) {
                            dots.push({ x, y, opacity: Math.random() * 0.4 + 0.15 });
                        }
                    }
                }
            }

            let startTime = Date.now();

            function draw() {
                ctx.clearRect(0, 0, width, height);

                dots.forEach(dot => {
                    ctx.beginPath();
                    ctx.arc(dot.x, dot.y, 1.2, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(45, 74, 62, ${dot.opacity})`;
                    ctx.fill();
                });

                const elapsedTotal = (Date.now() - startTime) / 1000;

                routes.forEach(route => {
                    const elapsed = elapsedTotal - route.start.delay;
                    if (elapsed <= 0) return;
                    const progress = Math.min(elapsed / 3, 1);

                    const sx = route.start.x * width, sy = route.start.y * height;
                    const ex = route.end.x * width, ey = route.end.y * height;
                    const x = sx + (ex - sx) * progress;
                    const y = sy + (ey - sy) * progress;

                    ctx.beginPath();
                    ctx.moveTo(sx, sy);
                    ctx.lineTo(x, y);
                    ctx.strokeStyle = '#2D4A3E';
                    ctx.lineWidth = 1.5;
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.arc(x, y, 3, 0, Math.PI * 2);
                    ctx.fillStyle = '#C9A227';
                    ctx.fill();
                });

                if (elapsedTotal > 12) startTime = Date.now();
                requestAnimationFrame(draw);
            }

            new ResizeObserver(resize).observe(canvas.parentElement);
            draw();
        }
    </script>
</body>
</html>