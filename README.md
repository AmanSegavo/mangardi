<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## 🔥 Mangardi Store — Game Account & Diamond Top-up Website

This is a Laravel-based web application developed using **Vite** as the frontend build tool.  
The project was built for a friend to run an online store that sells **game accounts** and offers **diamond top-up services** for popular games.

### ✨ Features

- Responsive and modern interface (using Vite & modern frontend tools)
- Game listing and account browsing
- Diamond top-up with secure ordering system
- Admin panel to manage accounts, prices, and orders

### ⚙️ Tech Stack

- **Laravel** (Backend Framework)
- **Vite** (Frontend asset bundler)
- **Blade** (Templating)
- **MySQL / SQLite** (Database)
- **Tailwind CSS** (optional if used for styling)

### 📦 Installation

```bash
git clone https://github.com/amansegavo/mangardi.git
cd mangardi
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
