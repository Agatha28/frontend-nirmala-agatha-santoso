<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Global Shipping - Frontend-Nirmala-Agatha-Santoso

Project ini menggunakan **Laravel** dan **AJAX (jQuery)**.  
Fitur utama:
- Pilih Negara → Pelabuhan → Barang
- Otomatis menampilkan description, harga, diskon, total
- Loading spinner saat fetch data
- Frontend responsive menggunakan Bootstrap 5

---

## Prerequisites

- PHP >= 8.x
- Composer
- Node.js & npm
- Git

---

🚀 How to Install & Run

Frontend Laravel + AJAX Project: Global Shipping 


1️⃣ Clone Repo

git clone https://github.com/Agatha28/frontend-nirmala-agatha-santoso.git

cd frontend-nirmala-agatha-santoso




2️⃣ Install Backend (Laravel)

composer install

cp .env.example .env

php artisan key:generate



Edit .env untuk sesuaikan database & konfigurasi.


3️⃣ Install Frontend

npm install

npm run dev    
# untuk development

npm run build   
# untuk production


4️⃣ Database (Opsional, kalau ada)

php artisan migrate



5️⃣ Jalankan Server

php artisan serve


Buka browser: http://127.0.0.1:8000
