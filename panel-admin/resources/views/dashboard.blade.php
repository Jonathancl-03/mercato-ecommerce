<x-app-layout>
    <div class="max-w-7xl mx-auto">

        <div class="dash-fade mb-8">
            <span class="text-xs font-semibold uppercase tracking-widest text-forest-600 dark:text-forest-500">Panel de control</span>
            <h1 class="font-display text-3xl md:text-4xl font-semibold text-ink-900 dark:text-white mt-2">Resumen general</h1>
        </div>

        <!-- Tarjetas de estadísticas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

            <div class="dash-fade rounded-2xl bg-ink-900 text-white p-6 relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-wide text-white/50">Ingresos</span>
                    <span class="w-8 h-8 rounded-full bg-mustard-500/20 text-mustard-500 flex items-center justify-center text-sm">S/</span>
                </div>
                <p class="font-display text-3xl font-semibold mt-3">S/ {{ number_format($stats['total_revenue'], 2) }}</p>
            </div>

            <div class="dash-fade rounded-2xl bg-white dark:bg-white/5 border border-stone-100 dark:border-white/10 p-6">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-wide text-ink-900/50 dark:text-white/40">Pedidos</span>
                    <span class="w-8 h-8 rounded-full bg-forest-600/10 text-forest-600 dark:text-forest-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    </span>
                </div>
                <p class="font-display text-3xl font-semibold mt-3 text-ink-900 dark:text-white">{{ $stats['total_orders'] }}</p>
            </div>

            <div class="dash-fade rounded-2xl bg-white dark:bg-white/5 border border-stone-100 dark:border-white/10 p-6">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-wide text-ink-900/50 dark:text-white/40">Productos</span>
                    <span class="w-8 h-8 rounded-full bg-mustard-500/10 text-mustard-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7" /></svg>
                    </span>
                </div>
                <p class="font-display text-3xl font-semibold mt-3 text-ink-900 dark:text-white">{{ $stats['total_products'] }}</p>
            </div>

            <div class="dash-fade rounded-2xl bg-white dark:bg-white/5 border border-stone-100 dark:border-white/10 p-6">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-wide text-ink-900/50 dark:text-white/40">Stock saludable</span>
                    <span class="w-8 h-8 rounded-full bg-red-50 dark:bg-red-500/10 text-red-500 flex items-center justify-center">★</span>
                </div>
                <p class="font-display text-3xl font-semibold mt-3 text-ink-900 dark:text-white">{{ $stockHealthPercent }}%</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Gráfico de barras: ingresos por mes -->
            <div class="dash-fade lg:col-span-2 rounded-2xl bg-white dark:bg-white/5 border border-stone-100 dark:border-white/10 p-6">
                <h3 class="font-semibold text-ink-900 dark:text-white mb-4">Ingresos (últimos 6 meses)</h3>
                <canvas id="revenueChart" height="130"></canvas>
            </div>

            <!-- Donut: salud de stock -->
            <div class="dash-fade rounded-2xl bg-white dark:bg-white/5 border border-stone-100 dark:border-white/10 p-6 flex flex-col items-center justify-center">
                <h3 class="font-semibold text-ink-900 dark:text-white mb-4 self-start">Salud de inventario</h3>
                <canvas id="stockDonut" width="160" height="160"></canvas>
                <p class="text-sm text-ink-900/50 dark:text-white/40 mt-4 text-center">
                    {{ $stockHealthPercent }}% de tus productos tienen stock saludable
                </p>
            </div>
        </div>

        <!-- Pedidos recientes -->
        <div class="dash-fade mt-6 rounded-2xl bg-white dark:bg-white/5 border border-stone-100 dark:border-white/10 overflow-hidden">
            <div class="p-5 border-b border-stone-100 dark:border-white/10 flex justify-between items-center">
                <h3 class="font-semibold text-ink-900 dark:text-white">Pedidos recientes</h3>
                <a href="{{ route('orders.index') }}" class="text-sm text-forest-600 hover:underline">Ver todos →</a>
            </div>
            @forelse($recentOrders as $order)
                <div class="flex items-center justify-between p-5 border-b border-stone-100 dark:border-white/10 last:border-0">
                    <div>
                        <p class="font-medium text-sm text-ink-900 dark:text-white">#{{ $order->id }} — {{ $order->user->name }}</p>
                        <p class="text-xs text-ink-900/40 dark:text-white/30">{{ $order->created_at->format('d M, H:i') }}</p>
                    </div>
                    <span class="text-mustard-500 font-semibold text-sm">S/ {{ number_format($order->total, 2) }}</span>
                </div>
            @empty
                <p class="p-5 text-sm text-ink-900/50 dark:text-white/40">Aún no hay pedidos.</p>
            @endforelse
        </div>
    </div>

    <style>
        .dash-fade { opacity: 0; transform: translateY(20px); }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap !== 'undefined') {
                gsap.to('.dash-fade', { opacity: 1, y: 0, duration: 0.5, stagger: 0.08, ease: 'power3.out' });
            }

            const labels = @json($monthLabels);
            const revenue = @json($monthlyRevenue);

            new Chart(document.getElementById('revenueChart'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: revenue,
                        backgroundColor: '#2D4A3E',
                        borderRadius: 6,
                        maxBarThickness: 40,
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(120,120,120,0.1)' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            new Chart(document.getElementById('stockDonut'), {
                type: 'doughnut',
                data: {
                    labels: ['Saludable', 'Bajo'],
                    datasets: [{
                        data: [{{ $stockHealthPercent }}, {{ 100 - $stockHealthPercent }}],
                        backgroundColor: ['#2D4A3E', '#C9A227'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    cutout: '72%',
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
</x-app-layout>