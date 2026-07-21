@php
    $testimonials = [
        ['text' => 'Encontré exactamente lo que buscaba y el envío llegó antes de lo esperado. Muy buena experiencia de compra.', 'name' => 'Valeria Torres', 'role' => 'Cliente frecuente'],
        ['text' => 'La calidad de los productos superó mis expectativas. El proceso de pago fue rápido y sin complicaciones.', 'name' => 'Diego Ramírez', 'role' => 'Comprador verificado'],
        ['text' => 'Excelente atención y variedad de categorías. Ya es mi tienda de confianza para comprar online.', 'name' => 'Camila Flores', 'role' => 'Cliente frecuente'],
        ['text' => 'El seguimiento del pedido fue claro en todo momento. Definitivamente volveré a comprar aquí.', 'name' => 'Andrés Quispe', 'role' => 'Comprador verificado'],
        ['text' => 'Los precios son justos y la web es muy fácil de usar. Encontré mi pedido en minutos.', 'name' => 'Lucía Mendoza', 'role' => 'Cliente frecuente'],
        ['text' => 'Muy buena selección de productos para el hogar. El empaque llegó en perfecto estado.', 'name' => 'Renzo Vargas', 'role' => 'Comprador verificado'],
        ['text' => 'La devolución que hice fue súper sencilla, sin trámites complicados. Gran servicio.', 'name' => 'Ariana Salazar', 'role' => 'Cliente frecuente'],
        ['text' => 'Compré varios artículos y todos llegaron a tiempo y bien descritos en la página.', 'name' => 'Mateo Huamán', 'role' => 'Comprador verificado'],
        ['text' => 'La experiencia de compra fue fluida de principio a fin. Recomiendo esta tienda sin duda.', 'name' => 'Fernanda Rojas', 'role' => 'Cliente frecuente'],
    ];

    $columns = array_chunk($testimonials, 3);

    function testimonialAvatarColor($name) {
        $colors = ['2D4A3E', 'C9A227', '1C1F26'];
        return $colors[strlen($name) % count($colors)];
    }

    function testimonialInitials($name) {
        $parts = explode(' ', $name);
        return strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
    }
@endphp

<section class="relative overflow-hidden py-24 bg-stone-50 dark:bg-ink-900">
    <style>
        @keyframes testimonialScrollUp {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }
        .testimonial-column {
            animation: testimonialScrollUp linear infinite;
        }
        .testimonial-column:hover {
            animation-play-state: paused;
        }
        .testimonial-card {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
        }
        .testimonial-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
        }
    </style>

    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col items-center text-center max-w-lg mx-auto mb-14">
            <span class="inline-block border border-forest-600/20 bg-white dark:bg-white/5 py-1 px-4 rounded-full text-xs font-semibold tracking-wide uppercase text-forest-700 dark:text-forest-500">
                Reseñas
            </span>
            <h2 class="font-display text-3xl md:text-4xl font-semibold mt-6 text-ink-900 dark:text-white">
                Lo que dicen nuestros clientes
            </h2>
            <p class="text-ink-900/50 dark:text-white/50 mt-4">
                Miles de compradores confían en Mercato para sus compras.
            </p>
        </div>

        <div class="flex justify-center gap-6 max-h-[600px] overflow-hidden"
             style="mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent); -webkit-mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);">

            @foreach($columns as $i => $col)
                <div class="flex-shrink-0 w-full max-w-xs {{ $i === 1 ? 'hidden md:block' : '' }} {{ $i === 2 ? 'hidden lg:block' : '' }}">
                    <div class="testimonial-column flex flex-col gap-6" style="animation-duration: {{ 16 + $i * 3 }}s;">
                        @for ($rep = 0; $rep < 2; $rep++)
                            @foreach($col as $t)
                                <div class="testimonial-card p-8 rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-white/5 shadow-sm">
                                    <p class="text-ink-900/70 dark:text-white/70 text-sm leading-relaxed">
                                        {{ $t['text'] }}
                                    </p>
                                    <div class="flex items-center gap-3 mt-6">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                             style="background-color: #{{ testimonialAvatarColor($t['name']) }};">
                                            {{ testimonialInitials($t['name']) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-sm text-ink-900 dark:text-white">{{ $t['name'] }}</p>
                                            <p class="text-xs text-ink-900/50 dark:text-white/50">{{ $t['role'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>