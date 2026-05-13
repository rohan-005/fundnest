# FundNest

FundNest is a Laravel-based crowdfunding and scholarship management platform built with Laravel, Blade, Tailwind CSS, and MySQL. The project allows users to explore scholarships, manage applications, and interact with funding opportunities through a modern web interface.

---

## Tech Stack

### Backend
- Laravel 13
- PHP 8.3
- MySQL

### Frontend
- Blade Templates
- Tailwind CSS
- Vite
- JavaScript

---

# Features

- User authentication
- Scholarship management
- Responsive UI
- Database-driven content
- Admin panel support
- Laravel Sanctum integration
- PDF generation support
- Secure environment configuration

---

# Local Installation

## 1. Clone Repository

```bash
git clone https://github.com/YOUR_USERNAME/fundnest.git

cd fundnest
```

---

## 2. Install PHP Dependencies

```bash
composer install
```

---

## 3. Install Node Dependencies

```bash
npm install
```

---

## 4. Create Environment File

```bash
cp .env.example .env
```

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Configure Database

Update `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fundnest
DB_USERNAME=root
DB_PASSWORD=
```

---

## 7. Run Migrations

```bash
php artisan migrate
```

---

## 8. Start Development Server

### Laravel Server

```bash
php artisan serve
```

### Vite Server

```bash
npm run dev
```



---

# Railway Database Configuration

Add these environment variables in Render:

```env
DB_CONNECTION=mysql
DB_HOST=YOUR_RAILWAY_HOST
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
```

---

# Render Deployment Steps

## 1. Push Code to GitHub

```bash
git add .
git commit -m "Deployment setup"
git push
```

---

## 2. Create Render Web Service

- Connect GitHub repository
- Select the main branch
- Add environment variables

---

## 3. Add Environment Variables

```env
APP_NAME=FundNest
APP_ENV=production
APP_DEBUG=false
APP_KEY=YOUR_APP_KEY

APP_URL=https://your-app.onrender.com

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

---

## 4. Deploy

Render automatically:
- Installs dependencies
- Builds Vite assets
- Deploys Laravel app

---

# Post Deployment Commands

Open Render Shell and run:

```bash
php artisan migrate

php artisan storage:link
```

---

# Common Issues

## Vite Build Error

If you get:

```bash
Could not resolve './bootstrap'
```

Create:

```text
resources/js/bootstrap.js
```

Add:

```js
import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
```

Install axios:

```bash
npm install axios
```

---

## Permission Errors

```bash
chmod -R 775 storage bootstrap/cache
```

---

## APP_KEY Missing

```bash
php artisan key:generate --show
```

---

# Project Structure

```text
fundnest/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
└── .env
```

---

# Future Improvements

- Payment gateway integration
- Email verification
- Cloudinary image uploads
- Queue workers
- Real-time notifications
- Admin analytics dashboard
- CI/CD pipeline

---

# License

This project is for educational and development purposes.