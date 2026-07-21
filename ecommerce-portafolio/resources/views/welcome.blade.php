<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mercato — Todo lo que necesitas, en un solo lugar</title>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* ===== ANIMACIONES BASE ===== */
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 35s linear infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .section-card {
            opacity: 0;
            transform: translateY(40px) scale(0.96);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .section-card.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .scroll-section {
            position: relative;
            overflow: hidden;
            height: 100vh;
            width: 100%;
            will-change: transform, opacity, filter;
        }

        .glass-pill {
            background: linear-gradient(145deg, rgba(45, 74, 62, 0.06) 0%, rgba(45, 74, 62, 0.02) 100%);
            border: 1px solid rgba(45, 74, 62, 0.1);
            backdrop-filter: blur(10px);
        }

        .dark .glass-pill {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.06) 0%, rgba(255, 255, 255, 0.02) 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .eyebrow {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        @keyframes scrollHint {

            0%,
            100% {
                transform: translateY(0);
                opacity: 0.5;
            }

            50% {
                transform: translateY(6px);
                opacity: 1;
            }
        }

        .scroll-hint {
            animation: scrollHint 2s ease-in-out infinite;
        }

        .spotlight-fade {
            opacity: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .spotlight-tooltip {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.9);
            color: white;
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 8px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .spotlight-hotspot:hover .spotlight-tooltip,
        .spotlight-hotspot:focus .spotlight-tooltip {
            opacity: 1;
        }

        .reveal-text {
            clip-path: inset(0 0 100% 0);
            transition: clip-path 1s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-text.visible {
            clip-path: inset(0 0 0 0);
        }

        .parallax-img {
            will-change: transform;
            transition: transform 0.1s linear;
        }
    </style>
</head>

<body class="antialiased bg-stone-50 dark:bg-ink-900" style="opacity: 0; transition: opacity 0.5s ease;"
    x-data="{ mobileOpen: false }">

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            document.body.style.opacity = '1';
        });
    </script>

    <!-- ===== HERO ===== -->
    <section class="scroll-section relative flex flex-col items-center bg-ink-900" id="hero">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 z-0 pointer-events-none"
            style="background: linear-gradient(180deg, rgba(20,23,28,0.35) 0%, rgba(20,23,28,0.05) 18%, rgba(45,74,62,0.15) 45%, rgba(20,23,28,0.55) 78%, rgba(20,23,28,0.85) 100%);">
        </div>

        <div class="relative z-30 w-full" x-data="{ scrolled: false }"
            @scroll.window="scrolled = (window.scrollY > 20)">
            <div class="w-full transition-all duration-300"
                :class="scrolled ? 'bg-white/90 dark:bg-ink-900/90 backdrop-blur-lg shadow-sm' : 'bg-transparent'">
                <header class="max-w-7xl mx-auto flex items-center justify-between py-4 px-4 sm:px-6">
                    <a href="{{ route('welcome') }}" class="font-display text-xl font-semibold transition-colors"
                        :class="scrolled ? 'text-forest-600 dark:text-white' : 'text-white'">
                        Mercato
                    </a>
                    <nav class="hidden lg:flex items-center gap-6">
                        <a href="{{ route('welcome') }}" class="text-sm font-medium transition-colors hover:opacity-70"
                            :class="scrolled ? 'text-ink-900/70 dark:text-white/70' : 'text-white/80'">Inicio</a>
                        <a href="{{ route('home') }}" class="text-sm font-medium transition-colors hover:opacity-70"
                            :class="scrolled ? 'text-ink-900/70 dark:text-white/70' : 'text-white/80'">Tienda</a>
                        <a href="{{ route('offers.index') }}"
                            class="text-sm font-medium transition-colors hover:opacity-70"
                            :class="scrolled ? 'text-ink-900/70 dark:text-white/70' : 'text-white/80'">Ofertas</a>
                    </nav>
                    <div class="flex items-center gap-4">
                        <div x-data="{
                                isDark: document.documentElement.classList.contains('dark'),
                                toggle() {
                                    this.isDark = !this.isDark;
                                    document.documentElement.classList.toggle('dark', this.isDark);
                                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                                }
                             }" @click="toggle()"
                            class="flex w-16 h-8 p-1 rounded-full cursor-pointer transition-all duration-300 flex-shrink-0 border"
                            :class="isDark ? 'bg-ink-900 border-stone-700' : (scrolled ? 'bg-white border-stone-100' : 'bg-white/10 border-white/30 backdrop-blur-sm')">
                            <div class="flex justify-between items-center w-full">
                                <div class="flex justify-center items-center w-6 h-6 rounded-full transition-transform duration-300"
                                    :class="isDark ? 'translate-x-0 bg-forest-600' : 'translate-x-8 bg-stone-100'">
                                    <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                    <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-mustard-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.5" style="display:none">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="flex justify-center items-center w-6 h-6 rounded-full transition-transform duration-300"
                                    :class="isDark ? '-translate-x-8' : ''">
                                    <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-ink-900/40" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.5" style="display:none">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                    <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-mustard-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        @auth
                            <a href="{{ route('orders.index') }}" data-magnetic
                                class="hidden sm:inline-block px-5 py-2 rounded-full text-sm font-medium transition-colors"
                                :class="scrolled ? 'bg-forest-600 text-white hover:bg-forest-700' : 'bg-white/15 text-white border border-white/30 backdrop-blur-sm hover:bg-white/25'">
                                Mi cuenta
                            </a>
                        @else
                            <a href="{{ route('login') }}" data-magnetic
                                class="hidden sm:inline-block px-5 py-2 rounded-full text-sm font-medium transition-colors"
                                :class="scrolled ? 'bg-forest-600 text-white hover:bg-forest-700' : 'bg-white/15 text-white border border-white/30 backdrop-blur-sm hover:bg-white/25'">
                                Iniciar sesión
                            </a>
                        @endauth

                        <button @click="mobileOpen = true" class="lg:hidden p-2 transition-colors"
                            :class="scrolled ? 'text-ink-900/70 dark:text-white/70' : 'text-white'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </header>
            </div>
        </div>

        <div class="relative z-10 w-full flex-1 flex flex-col items-center justify-center px-6 pb-16">
            <div class="fade-in-up flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/15 mx-auto mb-6 w-fit"
                style="animation-delay: 0s">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mustard-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span class="text-sm font-medium text-white/90">Nueva colección disponible</span>
            </div>
            <h1 class="fade-in-up font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-semibold text-white mb-4 tracking-tight leading-[1.05] text-center"
                style="animation-delay: 0.15s">
                Todo lo que buscas,<br>en un solo lugar
            </h1>
            <p class="fade-in-up text-sm sm:text-base md:text-lg text-white/70 leading-relaxed max-w-xl text-center mb-8"
                style="animation-delay: 0.3s">
                Muebles, electrónica, ropa y artículos para el hogar, seleccionados con cuidado y a un clic de
                distancia.
            </p>
            <div class="fade-in-up flex items-center gap-3" style="animation-delay: 0.45s">
                <a href="{{ route('home') }}" id="cta-catalogo" data-magnetic
                    class="inline-block px-8 py-3 rounded-full bg-white text-ink-900 font-semibold shadow-lg hover:bg-stone-100 transition-colors">
                    Ver catálogo
                </a>
                <a href="{{ route('offers.index') }}" data-magnetic
                    class="inline-block px-8 py-3 rounded-full border border-white/30 text-white font-semibold hover:bg-white/10 transition-colors">
                    Ver ofertas
                </a>
            </div>
            <div
                class="scroll-hint absolute bottom-8 left-1/2 -translate-x-1/2 z-20 hidden md:flex flex-col items-center gap-1 text-white/50">
                <span class="text-[10px] uppercase tracking-widest">Descubre más</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>
    </section>

    @if($spotlight)
        <!-- ===== SPOTLIGHT ===== -->
        <section id="spotlight"
            class="scroll-section relative bg-black flex flex-col items-center justify-center px-6 py-16">
            <canvas id="spotlight-particles" class="absolute inset-0 w-full h-full z-0"></canvas>
            <div
                class="absolute inset-0 flex items-center justify-center z-0 pointer-events-none select-none overflow-hidden">
                <span class="font-display font-bold uppercase text-white/[0.04] leading-none whitespace-nowrap"
                    style="font-size: 14vw; letter-spacing: -0.02em;">
                    {{ $spotlight->category->name }}
                </span>
            </div>
            <div class="relative z-10 flex flex-col items-center text-center w-full">
                <span
                    class="spotlight-fade inline-block px-4 py-1.5 rounded-full border border-white/20 bg-white/5 backdrop-blur-md text-xs font-semibold uppercase tracking-widest text-mustard-500 mb-6">
                    Producto en foco
                </span>
                <div id="spotlight-tilt-wrap" class="spotlight-fade relative w-56 h-56 md:w-80 md:h-80 mb-8"
                    style="animation-delay: 0.1s; perspective: 800px;">
                    <div id="spotlight-tilt" class="relative w-full h-full transition-transform duration-200 ease-out"
                        style="transform-style: preserve-3d;">
                        <img src="{{ $spotlight->image }}" alt="{{ $spotlight->name }}"
                            class="w-full h-full object-cover rounded-2xl shadow-2xl border border-white/10">
                        <button type="button" data-tooltip="Categoría: {{ $spotlight->category->name }}"
                            class="spotlight-hotspot absolute top-4 left-4 w-6 h-6 rounded-full bg-white/20 border border-white/40 backdrop-blur-sm flex items-center justify-center">
                            <span class="w-2 h-2 rounded-full bg-white animate-ping absolute"></span>
                            <span class="w-2 h-2 rounded-full bg-white relative"></span>
                        </button>
                        <button type="button"
                            data-tooltip="Precio: S/ {{ number_format($spotlight->discount_price ?? $spotlight->price, 2) }}"
                            class="spotlight-hotspot absolute bottom-6 right-6 w-6 h-6 rounded-full bg-white/20 border border-white/40 backdrop-blur-sm flex items-center justify-center">
                            <span class="w-2 h-2 rounded-full bg-white animate-ping absolute"></span>
                            <span class="w-2 h-2 rounded-full bg-white relative"></span>
                        </button>
                        <button type="button" data-tooltip="Stock disponible: {{ $spotlight->stock }} unidades"
                            class="spotlight-hotspot absolute top-1/2 -right-2 -translate-y-1/2 w-6 h-6 rounded-full bg-white/20 border border-white/40 backdrop-blur-sm flex items-center justify-center">
                            <span class="w-2 h-2 rounded-full bg-white animate-ping absolute"></span>
                            <span class="w-2 h-2 rounded-full bg-white relative"></span>
                        </button>
                    </div>
                </div>
                <h2 class="spotlight-fade font-display text-3xl md:text-5xl font-semibold text-white mb-3"
                    style="animation-delay: 0.2s">
                    {{ $spotlight->name }}
                </h2>
                <p class="spotlight-fade text-white/50 max-w-lg mb-8" style="animation-delay: 0.3s">
                    {{ Str::limit($spotlight->description, 120) }}
                </p>
                <a href="{{ route('products.show', $spotlight->slug) }}" data-magnetic
                    class="spotlight-fade inline-flex items-center gap-2 px-8 py-3 rounded-full bg-white text-black font-semibold hover:bg-stone-100 transition-colors"
                    style="animation-delay: 0.4s">
                    Comprar ahora
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H8m9 0v9" />
                    </svg>
                </a>
            </div>
        </section>
    @endif

    <!-- ===== PRODUCTOS DESTACADOS ===== -->
    <section class="scroll-section flex items-center bg-stone-50 dark:bg-ink-900">
        <div class="max-w-7xl mx-auto w-full px-4">
            <div class="flex items-end justify-between">
                <div>
                    <span class="eyebrow text-forest-600 dark:text-forest-500">Seleccionados para ti</span>
                    <h2 class="font-display text-3xl md:text-4xl font-semibold text-ink-900 dark:text-white mt-2">
                        Productos
                        destacados</h2>
                </div>
                <a href="{{ route('home') }}" data-magnetic
                    class="hidden sm:inline-block text-sm font-medium text-forest-600 hover:underline whitespace-nowrap">
                    Ver todo →
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                @foreach($featured as $product)
                    <div
                        class="section-card group relative flex flex-col items-center justify-start overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 text-center shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div
                            class="relative mb-4 flex h-40 w-full items-center justify-center overflow-hidden rounded-xl bg-stone-50 dark:bg-white/5">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="flex flex-grow flex-col items-center gap-1">
                            <h3 class="font-semibold text-ink-900 dark:text-white">{{ $product->name }}</h3>
                            <p class="text-sm text-ink-900/50 dark:text-white/50">{{ $product->category->name }}</p>
                        </div>
                        <div class="mt-4 flex flex-col items-center gap-2">
                            <span class="font-display text-2xl font-bold text-ink-900 dark:text-white">
                                S/ {{ number_format($product->discount_price ?? $product->price, 2) }}
                            </span>
                            <div
                                class="glass-pill flex items-center gap-2 rounded-full px-3 py-1 text-xs
                                                        {{ $product->stock <= 5 ? 'text-red-600' : 'text-forest-700 dark:text-forest-500' }}">
                                @if($product->stock <= 5)
                                    Últimas {{ $product->stock }} unidades
                                @else
                                    Stock disponible
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" data-magnetic
                            class="mt-4 w-full bg-ink-900 dark:bg-forest-600 text-white text-center py-2 rounded-full hover:bg-forest-700 transition-colors text-sm font-medium">
                            Ver producto
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8 sm:hidden">
                <a href="{{ route('home') }}" data-magnetic
                    class="inline-block text-sm font-medium text-forest-600 hover:underline">
                    Ver todo el catálogo →
                </a>
            </div>
        </div>
    </section>

    <!-- ===== CATEGORÍAS ===== -->
    <section class="scroll-section flex items-center bg-stone-50 dark:bg-ink-900">
        <div class="max-w-7xl mx-auto w-full px-4">
            <div class="text-center mb-12 section-card">
                <span class="eyebrow text-forest-600 dark:text-forest-500">Explora</span>
                <h2 class="font-display text-3xl md:text-4xl font-semibold text-ink-900 dark:text-white mt-2">Compra por
                    categoría</h2>
                <p class="text-ink-900/50 dark:text-white/50 mt-3">Encuentra justo lo que necesitas, más rápido</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $categorias = [
                        ['title' => 'Muebles', 'slug' => 'muebles', 'color' => '2D4A3E'],
                        ['title' => 'Electrónica', 'slug' => 'electronica', 'color' => 'C9A227'],
                        ['title' => 'Ropa', 'slug' => 'ropa', 'color' => '1C1F26'],
                        ['title' => 'Hogar', 'slug' => 'hogar', 'color' => '2D4A3E'],
                    ];
                @endphp
                @foreach($categorias as $cat)
                    <a href="{{ route('home') }}?category={{ $cat['slug'] }}" data-magnetic
                        class="section-card group relative bg-white dark:bg-ink-900 border border-stone-100 dark:border-white/10 rounded-2xl p-6 min-h-[240px] w-full overflow-hidden transition-all duration-500 hover:shadow-xl block">
                        <h3
                            class="text-center text-2xl font-display font-semibold relative z-10 text-forest-600 dark:text-forest-500 my-2 group-hover:text-forest-700 dark:group-hover:text-white transition-colors">
                            {{ $cat['title'] }}
                        </h3>
                        <div class="absolute inset-0 flex items-center justify-center p-4">
                            <img src="https://placehold.co/180x180/{{ $cat['color'] }}/FFFFFF?text={{ urlencode($cat['title']) }}&font=raleway"
                                alt="{{ $cat['title'] }}"
                                class="w-full max-w-[130px] h-auto object-contain opacity-90 group-hover:scale-110 group-hover:opacity-100 transition-all duration-500 rounded-xl">
                        </div>
                        <div
                            class="glass-pill absolute bottom-4 right-4 w-11 h-11 rounded-full flex items-center justify-center text-forest-600 dark:text-white group-hover:bg-forest-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H8m9 0v9" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONIALS (CORREGIDO: CENTRADO) ===== -->
    <div class="scroll-section flex items-center justify-center bg-stone-50 dark:bg-ink-900">
        <x-testimonials />
    </div>

    <!-- ===== BENEFICIOS ===== -->
    <section class="scroll-section flex items-center bg-stone-50 dark:bg-ink-900">
        <div class="max-w-7xl mx-auto w-full px-4">
            <div class="text-center mb-12 section-card">
                <span class="eyebrow text-mustard-500">Por qué elegirnos</span>
                <h2 class="font-display text-3xl md:text-4xl font-semibold text-ink-900 dark:text-white mt-2">Compra con
                    total confianza</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @php
                    $beneficios = [
                        ['title' => 'Envío rápido', 'desc' => 'Recibe tu pedido en tiempo récord, a todo el país.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['title' => 'Pagos seguros', 'desc' => 'Tus datos y transacciones siempre protegidos.', 'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'],
                        ['title' => 'Devoluciones fáciles', 'desc' => '30 días para cambios o devoluciones sin complicaciones.', 'icon' => 'M3 10h10a8 8 0 018 8v2M3 10l6 6M3 10l6-6'],
                    ];
                @endphp
                @foreach($beneficios as $b)
                    <div class="section-card glass-pill rounded-2xl p-8 text-center">
                        <div
                            class="w-14 h-14 mx-auto mb-4 rounded-full bg-forest-600/10 dark:bg-forest-600/20 flex items-center justify-center text-forest-600 dark:text-forest-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $b['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="font-display text-xl font-semibold text-ink-900 dark:text-white mb-2">{{ $b['title'] }}
                        </h3>
                        <p class="text-sm text-ink-900/50 dark:text-white/50">{{ $b['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cinematic-footer />

    <!-- Menú móvil -->
    <div x-show="mobileOpen" x-cloak class="fixed inset-0 z-50" style="display: none;">
        <div class="absolute inset-0 bg-black/50" @click="mobileOpen = false"></div>
        <div class="absolute inset-y-0 left-0 w-3/4 max-w-sm bg-white dark:bg-ink-900 p-6 flex flex-col gap-1">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-stone-100 dark:border-stone-700">
                <span class="font-display text-xl font-semibold text-forest-600">Mercato</span>
                <button @click="mobileOpen = false" class="p-2 text-ink-900/60 dark:text-white/60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <a href="{{ route('welcome') }}"
                class="px-2 py-3 rounded hover:bg-stone-50 dark:hover:bg-stone-800 text-ink-900 dark:text-white font-medium">Inicio</a>
            <a href="{{ route('home') }}"
                class="px-2 py-3 rounded hover:bg-stone-50 dark:hover:bg-stone-800 text-ink-900 dark:text-white font-medium">Tienda</a>
            <a href="{{ route('offers.index') }}"
                class="px-2 py-3 rounded hover:bg-stone-50 dark:hover:bg-stone-800 text-ink-900 dark:text-white font-medium">Ofertas</a>
            <div class="mt-6 pt-4 border-t border-stone-100 dark:border-stone-700">
                @auth
                    <a href="{{ route('orders.index') }}"
                        class="block w-full text-center bg-forest-600 text-white py-3 rounded-full font-medium">
                        Mi cuenta
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="block w-full text-center bg-forest-600 text-white py-3 rounded-full font-medium">
                        Iniciar sesión
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <script>
        document.getElementById('cta-catalogo').addEventListener('click', function (e) {
            e.preventDefault();
            const destino = this.href;
            document.body.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            document.body.style.opacity = '0';
            document.body.style.transform = 'scale(0.98)';
            setTimeout(function () {
                window.location.href = destino;
            }, 500);
        });

        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;
            gsap.registerPlugin(ScrollTrigger);

            // Tarjetas
            gsap.utils.toArray('.section-card').forEach(function (el, i) {
                gsap.to(el, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.8,
                    delay: (i % 4) * 0.1,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });

            // Revelado de texto
            document.querySelectorAll('.reveal-text').forEach(function (el) {
                ScrollTrigger.create({
                    trigger: el,
                    start: 'top 85%',
                    onEnter: function () { el.classList.add('visible'); },
                    once: true,
                });
            });

            // Parallax en imágenes
            document.querySelectorAll('.parallax-img').forEach(function (img) {
                const speed = parseFloat(img.getAttribute('data-speed')) || 0.2;
                gsap.to(img, {
                    y: (i) => -i * speed * 100,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: img.closest('.scroll-section'),
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1.5,
                    }
                });
            });

            // Secciones (Apple style)
            const sections = gsap.utils.toArray('.scroll-section');
            sections.forEach((section, i) => {
                if (i === 0) return;
                gsap.from(section, {
                    yPercent: 35,
                    opacity: 0,
                    scale: 0.96,
                    filter: 'blur(4px)',
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top bottom',
                        end: 'top center',
                        scrub: 2,
                    }
                });
                if (i > 1) {
                    const prev = sections[i - 1];
                    gsap.to(prev, {
                        scale: 0.95,
                        filter: 'blur(3px)',
                        opacity: 0.7,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: section,
                            start: 'top center',
                            end: 'top 20%',
                            scrub: 1.5,
                        }
                    });
                }
            });

            // Botones magnéticos
            document.querySelectorAll('[data-magnetic]').forEach(function (el) {
                el.addEventListener('mousemove', function (e) {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    gsap.to(el, { x: x * 0.15, y: y * 0.2, duration: 0.3, ease: 'power2.out' });
                });
                el.addEventListener('mouseleave', function () {
                    gsap.to(el, { x: 0, y: 0, duration: 0.7, ease: 'elastic.out(1, 0.3)' });
                });
            });

            // Tooltips
            document.querySelectorAll('.spotlight-hotspot').forEach(function (el) {
                const tooltip = document.createElement('span');
                tooltip.className = 'spotlight-tooltip';
                tooltip.textContent = el.getAttribute('data-tooltip');
                el.appendChild(tooltip);
            });

            // Parallax 3D spotlight
            const wrap = document.getElementById('spotlight-tilt-wrap');
            const tilt = document.getElementById('spotlight-tilt');
            if (wrap && tilt) {
                wrap.addEventListener('mousemove', function (e) {
                    const rect = wrap.getBoundingClientRect();
                    const x = (e.clientX - rect.left) / rect.width - 0.5;
                    const y = (e.clientY - rect.top) / rect.height - 0.5;
                    tilt.style.transform = `rotateY(${x * 18}deg) rotateX(${-y * 18}deg)`;
                });
                wrap.addEventListener('mouseleave', function () {
                    tilt.style.transform = 'rotateY(0deg) rotateX(0deg)';
                });
            }

            // Partículas spotlight
            const canvas = document.getElementById('spotlight-particles');
            if (canvas) {
                const ctx = canvas.getContext('2d');
                let width, height, particles = [];
                let mouse = { x: -9999, y: -9999 };

                function resize() {
                    const section = document.getElementById('spotlight');
                    width = canvas.width = section.clientWidth;
                    height = canvas.height = section.clientHeight;
                }

                function makeParticles() {
                    particles = [];
                    const count = Math.floor((width * height) / 12000);
                    for (let i = 0; i < count; i++) {
                        particles.push({
                            x: Math.random() * width,
                            y: Math.random() * height,
                            vx: (Math.random() - 0.5) * 0.3,
                            vy: (Math.random() - 0.5) * 0.3,
                            r: Math.random() * 1.5 + 0.5,
                            o: Math.random() * 0.4 + 0.1,
                        });
                    }
                }

                function draw() {
                    ctx.clearRect(0, 0, width, height);
                    particles.forEach(function (p) {
                        const dx = p.x - mouse.x,
                            dy = p.y - mouse.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < 90) {
                            p.x += dx / dist * 0.6;
                            p.y += dy / dist * 0.6;
                        }
                        p.x += p.vx;
                        p.y += p.vy;
                        if (p.x < 0) p.x = width;
                        if (p.x > width) p.x = 0;
                        if (p.y < 0) p.y = height;
                        if (p.y > height) p.y = 0;
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                        ctx.fillStyle = `rgba(201,162,39,${p.o})`;
                        ctx.fill();
                    });
                    requestAnimationFrame(draw);
                }

                const section = document.getElementById('spotlight');
                section.addEventListener('mousemove', function (e) {
                    const rect = section.getBoundingClientRect();
                    mouse.x = e.clientX - rect.left;
                    mouse.y = e.clientY - rect.top;
                });
                section.addEventListener('mouseleave', function () {
                    mouse.x = -9999;
                    mouse.y = -9999;
                });

                new ResizeObserver(function () {
                    resize();
                    makeParticles();
                }).observe(section);
                resize();
                makeParticles();
                draw();
            }
        });
    </script>
</body>

</html>