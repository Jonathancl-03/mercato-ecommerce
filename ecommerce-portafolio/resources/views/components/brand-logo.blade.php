@props(['size' => 'text-2xl'])

<a href="{{ route('welcome') }}" data-magnetic-logo
   class="brand-logo relative inline-flex items-center font-display {{ $size }} font-semibold text-forest-600 dark:text-forest-500 group">
    <span class="relative z-10 transition-colors duration-300 group-hover:text-forest-700 dark:group-hover:text-white">
        Mercato
    </span>
    <span class="brand-logo-glow absolute -inset-3 rounded-full blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-0 pointer-events-none"
          style="background: radial-gradient(circle, rgba(45,74,62,0.25) 0%, rgba(201,162,39,0.15) 60%, transparent 80%);"></span>
</a>

<style>
    .brand-logo {
        opacity: 0;
        animation: brandLogoIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes brandLogoIn {
        from { opacity: 0; transform: translateY(-8px); letter-spacing: -0.02em; }
        to { opacity: 1; transform: translateY(0); letter-spacing: normal; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof gsap === 'undefined') return;

        document.querySelectorAll('[data-magnetic-logo]').forEach(function (el) {
            el.addEventListener('mousemove', function (e) {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                gsap.to(el, { x: x * 0.15, y: y * 0.25, duration: 0.3, ease: 'power2.out' });
            });
            el.addEventListener('mouseleave', function () {
                gsap.to(el, { x: 0, y: 0, duration: 0.7, ease: 'elastic.out(1, 0.3)' });
            });
        });
    });
</script>