// ===== Datos de ejemplo =====
const PRODUCTS = [
    { id: 1, name: 'Silla de madera', category: 'Muebles', price: 150.00, image: 'https://placehold.co/300x300/2D4A3E/FFFFFF?text=Silla' },
    { id: 2, name: 'Mesa de centro', category: 'Muebles', price: 320.00, image: 'https://placehold.co/300x300/2D4A3E/FFFFFF?text=Mesa' },
    { id: 3, name: 'Audífonos Bluetooth', category: 'Electrónica', price: 89.90, image: 'https://placehold.co/300x300/C9A227/FFFFFF?text=Audifonos' },
    { id: 4, name: 'Smartwatch', category: 'Electrónica', price: 199.00, image: 'https://placehold.co/300x300/C9A227/FFFFFF?text=Smartwatch' },
    { id: 5, name: 'Polo básico', category: 'Ropa', price: 39.90, image: 'https://placehold.co/300x300/1C1F26/FFFFFF?text=Polo' },
    { id: 6, name: 'Lámpara de escritorio', category: 'Hogar', price: 65.00, image: 'https://placehold.co/300x300/2D4A3E/FFFFFF?text=Lampara' },
];

const CATEGORIES = [
    { title: 'Muebles', color: '2D4A3E' },
    { title: 'Electrónica', color: 'C9A227' },
    { title: 'Ropa', color: '1C1F26' },
    { title: 'Hogar', color: '2D4A3E' },
];

// ===== Tema oscuro =====
function toggleTheme() {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
}

// ===== Carrito (localStorage) =====
function getCart() {
    return JSON.parse(localStorage.getItem('mercato_demo_cart') || '[]');
}
function saveCart(cart) {
    localStorage.setItem('mercato_demo_cart', JSON.stringify(cart));
    updateCartBadge();
}
function addToCart(id) {
    const cart = getCart();
    const existing = cart.find(i => i.id === id);
    if (existing) existing.qty += 1;
    else cart.push({ id, qty: 1 });
    saveCart(cart);
    renderCartPanel();
}
function removeFromCart(id) {
    saveCart(getCart().filter(i => i.id !== id));
    renderCartPanel();
}
function updateCartBadge() {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;
    const count = getCart().reduce((sum, i) => sum + i.qty, 0);
    if (count > 0) {
        badge.textContent = count;
        badge.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
    }
}

function toggleCart() {
    const panel = document.getElementById('cart-panel');
    if (!panel) return;
    panel.classList.toggle('hidden');
    renderCartPanel();
}

function renderCartPanel() {
    const container = document.getElementById('cart-items');
    const totalEl = document.getElementById('cart-total');
    if (!container) return;

    const cart = getCart();
    if (cart.length === 0) {
        container.innerHTML = '<p class="text-ink-900/50 dark:text-white/40 text-sm">Tu carrito está vacío.</p>';
        if (totalEl) totalEl.textContent = 'S/ 0.00';
        return;
    }

    let total = 0;
    container.innerHTML = cart.map(item => {
        const product = PRODUCTS.find(p => p.id === item.id);
        const subtotal = product.price * item.qty;
        total += subtotal;
        return `
            <div class="flex items-center justify-between gap-3 border-b border-stone-100 dark:border-white/10 pb-3">
                <div>
                    <p class="font-medium text-sm">${product.name}</p>
                    <p class="text-xs text-ink-900/50 dark:text-white/40">x${item.qty} · S/ ${subtotal.toFixed(2)}</p>
                </div>
                <button onclick="removeFromCart(${item.id})" class="text-red-500 text-xs hover:underline">Quitar</button>
            </div>
        `;
    }).join('');

    if (totalEl) totalEl.textContent = 'S/ ' + total.toFixed(2);
}

// ===== Render de productos (tienda.html) =====
function renderProducts() {
    const container = document.getElementById('productos');
    if (!container) return;

    container.innerHTML = PRODUCTS.map(p => `
        <div class="group relative flex flex-col items-center justify-start overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 text-center shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="relative mb-4 flex h-40 w-full items-center justify-center overflow-hidden rounded-xl bg-stone-50 dark:bg-white/5">
                <img src="${p.image}" alt="${p.name}" class="h-full w-full object-cover">
            </div>
            <h3 class="font-semibold">${p.name}</h3>
            <p class="text-sm text-ink-900/50 dark:text-white/50">${p.category}</p>
            <span class="font-display text-2xl font-bold mt-3">S/ ${p.price.toFixed(2)}</span>
            <button onclick="addToCart(${p.id})" class="mt-4 w-full bg-ink-900 dark:bg-forest-600 text-white text-center py-2 rounded-full hover:bg-forest-700 transition-colors text-sm font-medium">
                Agregar al carrito
            </button>
        </div>
    `).join('');
}

// ===== Render de categorías (index.html) =====
function renderCategories() {
    const container = document.getElementById('categorias');
    if (!container) return;

    container.innerHTML = CATEGORIES.map(c => `
        <a href="tienda.html" class="group relative bg-white dark:bg-ink-900 border border-stone-100 dark:border-white/10 rounded-2xl p-6 min-h-[200px] overflow-hidden block hover:shadow-xl transition-all">
            <h3 class="text-center text-xl font-display font-semibold text-forest-600 my-2">${c.title}</h3>
            <div class="absolute inset-0 flex items-center justify-center p-4">
                <img src="https://placehold.co/150x150/${c.color}/FFFFFF?text=${encodeURIComponent(c.title)}" class="w-full max-w-[110px] rounded-xl opacity-90 group-hover:scale-110 transition-transform">
            </div>
        </a>
    `).join('');
}

// ===== Marquee de imágenes (index.html) =====
function renderMarquee() {
    const container = document.getElementById('marquee');
    if (!container) return;
    const images = CATEGORIES.concat(CATEGORIES).map(c =>
        `<div class="h-48 md:h-64 flex-shrink-0"><img src="https://placehold.co/300x400/${c.color}/FFFFFF?text=${encodeURIComponent(c.title)}" class="h-full rounded-2xl shadow-md"></div>`
    ).join('');
    container.innerHTML = images + images;
}

document.addEventListener('DOMContentLoaded', function () {
    renderProducts();
    renderCategories();
    renderMarquee();
    updateCartBadge();
    renderCartPanel();
});

// ===== Render extendido para index.html (versión avanzada) =====
function renderDestacados() {
    const container = document.getElementById('destacados');
    if (!container) return;
    container.innerHTML = PRODUCTS.map((p, i) => `
        <div class="section-card group relative flex flex-col items-start overflow-hidden rounded-[1.5rem] border border-stone-200/80 dark:border-white/10 bg-white dark:bg-ink-900 p-5 text-left shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
            <div class="relative mb-4 flex h-40 w-full items-center justify-center overflow-hidden rounded-2xl bg-stone-50 dark:bg-white/5">
                <img src="${p.image}" alt="${p.name}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="flex w-full items-center justify-between text-[11px] font-semibold uppercase tracking-[0.2em] text-stone-400">
                <span>${p.category}</span>
                <span class="rounded-full bg-stone-100 dark:bg-white/10 px-2.5 py-1 text-stone-600 dark:text-white/70">0${i + 1}</span>
            </div>
            <h3 class="mt-4 font-semibold">${p.name}</h3>
            <span class="font-display text-2xl font-bold mt-3">S/ ${p.price.toFixed(2)}</span>
            <a href="tienda.html" class="mt-5 w-full rounded-full bg-ink-900 dark:bg-forest-600 px-4 py-2.5 text-center text-sm font-medium text-white hover:bg-forest-700 transition-colors">Ver producto</a>
        </div>
    `).join('');
}

function renderCategoriasAvanzado() {
    const container = document.getElementById('categorias');
    if (!container) return;
    container.innerHTML = CATEGORIES.map(c => `
        <a href="tienda.html" class="section-card group relative block min-h-[240px] overflow-hidden rounded-[1.5rem] border border-stone-200/80 dark:border-white/10 bg-white dark:bg-ink-900 p-6 hover:-translate-y-1 hover:shadow-xl transition-all duration-500">
            <h3 class="relative z-10 text-center text-2xl font-display font-semibold text-forest-700 dark:text-forest-400 group-hover:text-forest-600 dark:group-hover:text-white transition-colors">${c.title}</h3>
            <div class="absolute inset-0 flex items-center justify-center p-4">
                <img src="https://placehold.co/180x180/${c.color}/FFFFFF?text=${encodeURIComponent(c.title)}" class="h-auto w-full max-w-[130px] rounded-xl object-contain opacity-90 group-hover:scale-110 transition-all duration-500">
            </div>
            <div class="glass-pill absolute bottom-4 right-4 flex h-11 w-11 items-center justify-center rounded-full text-forest-600 dark:text-white group-hover:bg-forest-600 group-hover:text-white transition-all">→</div>
        </a>
    `).join('');
}

function renderTestimonios() {
    const container = document.getElementById('testimonios');
    if (!container) return;
    const testimonios = [
        { text: 'Encontré exactamente lo que buscaba y el envío llegó antes de lo esperado.', name: 'Valeria Torres' },
        { text: 'La calidad de los productos superó mis expectativas. Muy recomendado.', name: 'Diego Ramírez' },
        { text: 'Excelente atención y variedad de categorías. Ya es mi tienda de confianza.', name: 'Camila Flores' },
    ];
    container.innerHTML = testimonios.map(t => `
        <div class="rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-white/5 p-6">
            <p class="text-sm text-ink-900/70 dark:text-white/70 leading-relaxed">${t.text}</p>
            <p class="font-semibold text-sm mt-4">${t.name}</p>
        </div>
    `).join('');
}

function renderSpotlight() {
    const p = PRODUCTS[0];
    if (!p) return;
    document.getElementById('spotlight-name').textContent = p.name;
    document.getElementById('spotlight-cat').textContent = p.category;
    document.getElementById('spotlight-price').textContent = 'S/ ' + p.price.toFixed(2);
    document.getElementById('spotlight-img').src = p.image;
    document.getElementById('spotlight-img').alt = p.name;
}

function initHeroNavScroll() {
    const nav = document.getElementById('hero-nav');
    const logo = document.getElementById('nav-logo');
    const links = document.querySelectorAll('.nav-link');
    if (!nav) return;
    window.addEventListener('scroll', function () {
        if (window.scrollY > 20) {
            nav.classList.add('bg-white/90', 'dark:bg-ink-900/90', 'backdrop-blur-lg', 'shadow-sm');
            logo.classList.remove('text-white');
            logo.classList.add('text-forest-600', 'dark:text-white');
            links.forEach(l => { l.classList.remove('text-white/80'); l.classList.add('text-ink-900/70', 'dark:text-white/70'); });
        } else {
            nav.classList.remove('bg-white/90', 'dark:bg-ink-900/90', 'backdrop-blur-lg', 'shadow-sm');
            logo.classList.add('text-white');
            logo.classList.remove('text-forest-600', 'dark:text-white');
            links.forEach(l => { l.classList.add('text-white/80'); l.classList.remove('text-ink-900/70', 'dark:text-white/70'); });
        }
    });
}

function initGsapAnimations() {
    if (typeof gsap === 'undefined') return;
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray('.section-card').forEach(function (el, i) {
        gsap.to(el, {
            opacity: 1, y: 0, scale: 1, duration: 0.8, delay: (i % 4) * 0.1,
            ease: 'power3.out',
            scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none none' }
        });
    });

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
}

function initSpotlightTilt() {
    const wrap = document.getElementById('spotlight-tilt-wrap');
    const tilt = document.getElementById('spotlight-tilt');
    if (!wrap || !tilt) return;
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

function initSpotlightParticles() {
    const canvas = document.getElementById('spotlight-particles');
    const section = document.getElementById('spotlight');
    if (!canvas || !section) return;
    const ctx = canvas.getContext('2d');
    let width, height, particles = [];
    let mouse = { x: -9999, y: -9999 };

    function resize() { width = canvas.width = section.clientWidth; height = canvas.height = section.clientHeight; }
    function makeParticles() {
        particles = [];
        const count = Math.floor((width * height) / 12000);
        for (let i = 0; i < count; i++) {
            particles.push({ x: Math.random() * width, y: Math.random() * height, vx: (Math.random() - 0.5) * 0.3, vy: (Math.random() - 0.5) * 0.3, r: Math.random() * 1.5 + 0.5, o: Math.random() * 0.4 + 0.1 });
        }
    }
    function draw() {
        ctx.clearRect(0, 0, width, height);
        particles.forEach(function (p) {
            const dx = p.x - mouse.x, dy = p.y - mouse.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < 90) { p.x += dx / dist * 0.6; p.y += dy / dist * 0.6; }
            p.x += p.vx; p.y += p.vy;
            if (p.x < 0) p.x = width; if (p.x > width) p.x = 0;
            if (p.y < 0) p.y = height; if (p.y > height) p.y = 0;
            ctx.beginPath(); ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(201,162,39,${p.o})`; ctx.fill();
        });
        requestAnimationFrame(draw);
    }
    section.addEventListener('mousemove', function (e) {
        const rect = section.getBoundingClientRect();
        mouse.x = e.clientX - rect.left; mouse.y = e.clientY - rect.top;
    });
    section.addEventListener('mouseleave', function () { mouse.x = -9999; mouse.y = -9999; });
    new ResizeObserver(function () { resize(); makeParticles(); }).observe(section);
    resize(); makeParticles(); draw();
}

document.addEventListener('DOMContentLoaded', function () {
    renderDestacados();
    renderCategoriasAvanzado();
    renderTestimonios();
    renderSpotlight();
    initHeroNavScroll();
    initGsapAnimations();
    initSpotlightTilt();
    initSpotlightParticles();
});