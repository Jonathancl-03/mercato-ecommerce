\# Mercato — E-commerce full-stack (Laravel)



Proyecto de portafolio: una tienda online completa y su panel de administración, construidos como dos aplicaciones Laravel independientes que comparten una misma base de datos.



\## Estructura



\- `ecommerce-portafolio/` — Tienda pública: landing, catálogo, carrito, checkout, favoritos, ofertas, pedidos.

\- `panel-admin/` — Panel de administración: CRUD de productos, gestión de pedidos, dashboard con estadísticas.



\## Stack



\- Laravel 11 + Blade

\- Tailwind CSS + Alpine.js

\- SQLite

\- GSAP (animaciones)



\## Instalación local



\### 1. Tienda



```bash

cd ecommerce-portafolio

composer install

npm install

copy .env.example .env

php artisan key:generate

php artisan migrate --seed

npm run build

php artisan serve

```



Disponible en `http://localhost:8000`



\### 2. Panel admin



```bash

cd panel-admin

composer install

npm install

copy .env.example .env

php artisan key:generate

npm run build

php artisan serve --port=8001

```



Disponible en `http://localhost:8001`



⚠️ El panel admin \*\*no necesita migrar\*\* — usa la misma base de datos SQLite que la tienda (configurado en `panel-admin/.env` con una ruta relativa a `../ecommerce-portafolio/database/database.sqlite`).



\## Usuario de prueba



\- Email: `test@example.com`

\- Password: `password`

\- Rol: admin (acceso completo al panel)

