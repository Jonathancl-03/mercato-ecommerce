<footer class="relative overflow-hidden bg-ink-900 text-white" id="cinematic-footer">

    <style>
        @keyframes footerBreathe {
            0% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            100% { transform: translate(-50%, -50%) scale(1.15); opacity: 0.9; }
        }
        @keyframes footerMarquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        @keyframes footerHeartbeat {
            0%, 100% { transform: scale(1); }
            15%, 45% { transform: scale(1.3); }
            30% { transform: scale(1); }
        }
        .footer-breathe { animation: footerBreathe 8s ease-in-out infinite alternate; }
        .footer-marquee { animation: footerMarquee 30s linear infinite; }
        .footer-heartbeat { animation: footerHeartbeat 1.8s ease-in-out infinite; }

        .footer-glass-pill {
            background: linear-gradient(145deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.02) 100%);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(16px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .footer-glass-pill:hover {
            background: linear-gradient(145deg, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.04) 100%);
            border-color: rgba(255,255,255,0.25);
        }

        .footer-giant-text {
            font-size: 20vw;
            line-height: 0.75;
            font-weight: 700;
            letter-spacing: -0.03em;
            color: transparent;
            -webkit-text-stroke: 1px rgba(255,255,255,0.06);
            background: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, transparent 60%);
            -webkit-background-clip: text;
            background-clip: text;
        }

        .footer-social-icon {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.3s ease;
        }
        .footer-social-icon:hover {
            transform: translateY(-3px);
        }
    </style>

    <!-- ===== SECCIÓN CINEMATOGRÁFICA (CTA) ===== -->
    <div class="relative min-h-[65vh] flex flex-col justify-between overflow-hidden">

        <div class="footer-breathe absolute left-1/2 top-1/2 h-[50vh] w-[70vw] rounded-full blur-[90px] pointer-events-none z-0"
             style="background: radial-gradient(circle, rgba(45,74,62,0.35) 0%, rgba(201,162,39,0.2) 45%, transparent 70%);"></div>

        <div class="footer-giant-text absolute -bottom-[4vh] left-1/2 -translate-x-1/2 whitespace-nowrap z-0 pointer-events-none select-none font-display">
            MERCATO
        </div>

        <div class="absolute top-10 left-0 w-full overflow-hidden border-y border-white/10 bg-white/5 backdrop-blur-md py-3 z-10 -rotate-2 scale-110">
            <div class="flex w-max footer-marquee text-xs md:text-sm font-bold tracking-[0.3em] text-white/50 uppercase">
                @for ($i = 0; $i < 2; $i++)
                    <div class="flex items-center space-x-10 px-6">
                        <span>Envíos a todo el país</span> <span class="text-forest-500/60">✦</span>
                        <span>Pagos seguros</span> <span class="text-mustard-500/60">✦</span>
                        <span>Devoluciones fáciles</span> <span class="text-forest-500/60">✦</span>
                        <span>Atención personalizada</span> <span class="text-mustard-500/60">✦</span>
                    </div>
                @endfor
            </div>
        </div>

        <div class="footer-fade-target relative z-10 flex flex-1 flex-col items-center justify-center px-6 mt-24 w-full max-w-5xl mx-auto text-center" style="opacity:0; transform: translateY(30px);">
            <h2 class="font-display text-4xl md:text-6xl font-semibold mb-10">
                ¿Listo para encontrar lo que buscas?
            </h2>

            <div class="flex flex-col items-center gap-5 w-full">
                <div class="flex flex-wrap justify-center gap-4 w-full">
                    <a href="{{ route('home') }}" data-magnetic class="footer-glass-pill px-8 py-4 rounded-full font-semibold text-sm md:text-base">
                        Ver catálogo
                    </a>
                    @auth
                        <a href="{{ route('orders.index') }}" data-magnetic class="footer-glass-pill px-8 py-4 rounded-full font-semibold text-sm md:text-base">
                            Mis pedidos
                        </a>
                    @else
                        <a href="{{ route('login') }}" data-magnetic class="footer-glass-pill px-8 py-4 rounded-full font-semibold text-sm md:text-base">
                            Iniciar sesión
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FOOTER ESTRUCTURADO ===== -->
    <div class="relative z-10 border-t border-white/10 bg-ink-900">
        <div class="max-w-7xl mx-auto px-6 py-16">

            <!-- Newsletter -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-12 border-b border-white/10 mb-12">
                <div>
                    <h3 class="font-display text-2xl font-semibold mb-1">Entérate primero</h3>
                    <p class="text-white/50 text-sm">Ofertas, nuevos productos y novedades directo a tu correo.</p>
                </div>
                <form class="flex w-full md:w-auto gap-2" onsubmit="event.preventDefault(); this.querySelector('button').textContent = '¡Gracias!';">
                    <input type="email" required placeholder="tu@correo.com"
                        class="flex-1 md:w-72 bg-white/5 border border-white/15 rounded-full px-5 py-3 text-sm placeholder:text-white/30 focus:outline-none focus:border-forest-500">
                    <button type="submit" class="bg-forest-600 hover:bg-forest-700 transition-colors text-white px-6 py-3 rounded-full text-sm font-semibold whitespace-nowrap">
                        Suscribirme
                    </button>
                </form>
            </div>

            <!-- Columnas -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-12">

                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('welcome') }}" class="font-display text-2xl font-semibold text-white">Mercato</a>
                    <p class="text-white/40 text-sm mt-3 leading-relaxed">
                        Todo lo que buscas, en un solo lugar. Calidad y confianza en cada compra.
                    </p>
                </div>

                <div>
                    <h4 class="text-xs uppercase tracking-widest text-white/40 font-semibold mb-4">Categorías</h4>
                    <ul class="space-y-2.5 text-sm text-white/60">
                        <li><a href="{{ route('home') }}?category=muebles" class="hover:text-white transition-colors">Muebles</a></li>
                        <li><a href="{{ route('home') }}?category=electronica" class="hover:text-white transition-colors">Electrónica</a></li>
                        <li><a href="{{ route('home') }}?category=ropa" class="hover:text-white transition-colors">Ropa</a></li>
                        <li><a href="{{ route('home') }}?category=hogar" class="hover:text-white transition-colors">Hogar</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs uppercase tracking-widest text-white/40 font-semibold mb-4">Mi cuenta</h4>
                    <ul class="space-y-2.5 text-sm text-white/60">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Catálogo</a></li>
                        @auth
                            <li><a href="{{ route('cart.index') }}" class="hover:text-white transition-colors">Carrito</a></li>
                            <li><a href="{{ route('orders.index') }}" class="hover:text-white transition-colors">Mis pedidos</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Iniciar sesión</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Crear cuenta</a></li>
                        @endauth
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs uppercase tracking-widest text-white/40 font-semibold mb-4">Ayuda</h4>
                    <ul class="space-y-2.5 text-sm text-white/60">
                        <li><a href="#" class="hover:text-white transition-colors">Preguntas frecuentes</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Envíos y devoluciones</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Términos de servicio</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Política de privacidad</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs uppercase tracking-widest text-white/40 font-semibold mb-4">Contacto</h4>
                    <ul class="space-y-2.5 text-sm text-white/60">
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            hola@mercato.com
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            +51 999 999 999
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Lima, Perú
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Redes sociales + métodos de pago -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-8 border-t border-white/10">

                <div class="flex items-center gap-3">
                    <a href="#" data-magnetic class="footer-social-icon footer-glass-pill w-10 h-10 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    <a href="#" data-magnetic class="footer-social-icon footer-glass-pill w-10 h-10 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163C8.741 0 8.332.014 7.052.072 2.695.272.273 2.69.073 7.052.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.332 23.986 8.741 24 12 24s3.668-.014 4.948-.072c4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.668-.072-4.948-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" data-magnetic class="footer-social-icon footer-glass-pill w-10 h-10 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0115.54 3h-3.09v12.4a2.592 2.592 0 01-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6 0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64 0 3.33 2.76 5.7 5.69 5.7 3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 004.3 1.38V7.3s-1.88.09-3.24-1.48z"/></svg>
                    </a>
                    <a href="#" data-magnetic class="footer-social-icon footer-glass-pill w-10 h-10 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.665 3.717l-19.13 7.128c-1.301.499-1.293 1.193-.239 1.517l4.905 1.523 1.881 5.964c.238.607.578.673.949.404.371-.27.529-.437.529-.437l2.913-2.792 4.902 3.629c.9.499 1.55.242 1.774-.836l3.211-15.128c.32-1.312-.502-1.905-1.695-1.972z"/></svg>
                    </a>
                </div>

                <div class="flex items-center gap-2 text-white/30 text-xs font-semibold">
                    <span class="px-2 py-1 rounded border border-white/15">VISA</span>
                    <span class="px-2 py-1 rounded border border-white/15">MASTERCARD</span>
                    <span class="px-2 py-1 rounded border border-white/15">YAPE</span>
                    <span class="px-2 py-1 rounded border border-white/15">PLIN</span>
                </div>
            </div>
        </div>

        <!-- Barra final -->
        <div class="relative z-20 w-full py-6 px-6 md:px-12 flex flex-col md:flex-row items-center justify-between gap-4 border-t border-white/10">
            <div class="text-white/40 text-[10px] md:text-xs font-semibold tracking-widest uppercase order-2 md:order-1">
                © {{ date('Y') }} Mercato. Todos los derechos reservados.
            </div>

            <div class="footer-glass-pill px-5 py-2.5 rounded-full flex items-center gap-2 order-1 md:order-2">
                <span class="text-white/50 text-[10px] md:text-xs font-bold uppercase tracking-widest">Hecho con</span>
                <span class="footer-heartbeat text-sm text-red-500 inline-block">❤</span>
                <span class="text-white/50 text-[10px] md:text-xs font-bold uppercase tracking-widest">por</span>
                <span class="text-white font-bold text-xs md:text-sm ml-1">Jonathan</span>
            </div>

            <button type="button" id="footer-back-to-top" data-magnetic
                class="w-11 h-11 rounded-full footer-glass-pill flex items-center justify-center text-white/60 hover:text-white order-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </button>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof gsap === 'undefined') return;
        gsap.registerPlugin(ScrollTrigger);

        gsap.to('.footer-fade-target', {
            opacity: 1,
            y: 0,
            duration: 1,
            scrollTrigger: {
                trigger: '#cinematic-footer',
                start: 'top 70%',
            }
        });

        document.querySelectorAll('[data-magnetic]').forEach(function (el) {
            el.addEventListener('mousemove', function (e) {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                gsap.to(el, { x: x * 0.3, y: y * 0.3, duration: 0.4, ease: 'power2.out' });
            });
            el.addEventListener('mouseleave', function () {
                gsap.to(el, { x: 0, y: 0, duration: 1, ease: 'elastic.out(1, 0.3)' });
            });
        });

        const backToTop = document.getElementById('footer-back-to-top');
        if (backToTop) {
            backToTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    });
</script>