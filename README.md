# Hukum Roka – Dynamic Portfolio Website

A fully dynamic, database-driven personal portfolio built with **Laravel 12**, **MySQL**, **Tailwind CSS v4**, and **Filament** admin panel.

---

## Tech Stack

| Layer     | Technology                        |
|-----------|-----------------------------------|
| Backend   | PHP 8.2, Laravel 12               |
| Frontend  | Tailwind CSS v4, Alpine.js, Vite  |
| Database  | MySQL                             |
| Admin     | Filament v3                       |
| Icons     | Font Awesome 6                    |

---

## First-Time Setup

### Prerequisites
- PHP 8.2+ (XAMPP recommended)
- Composer 2.x
- Node.js 18+ and npm
- MySQL (via XAMPP or standalone)

---

### Step 1 — Create the MySQL database

Open phpMyAdmin (http://localhost/phpmyadmin) or MySQL CLI and run:

```sql
CREATE DATABASE portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### Step 2 — Install PHP dependencies (includes Filament)

Open a terminal inside `d:\web Projects\MyPortfolio` and run:

```bash
composer update
```

---

### Step 3 — Install Node dependencies and build assets

```bash
npm install
npm run build
```

---

### Step 4 — Run migrations and seed the database

```bash
php artisan migrate --seed
```

This creates all tables and populates them with realistic sample data for Hukum Roka.

---

### Step 5 — Create the storage symlink

```bash
php artisan storage:link
```

This makes uploaded images accessible from the browser.

---

### Step 6 — Install Filament assets

```bash
php artisan filament:install --panels
```

If Filament asks to publish assets, confirm yes.

---

### Step 7 — Start the development server

```bash
php artisan serve
```

Then open **http://localhost:8000** in your browser.

For live asset reloading during development, run in a second terminal:

```bash
npm run dev
```

---

## Admin Dashboard

Navigate to **http://localhost:8000/admin**

Default credentials (created by the seeder):

| Field    | Value                   |
|----------|-------------------------|
| Email    | admin@hukumroka.com     |
| Password | password                |

**Change this password immediately after first login.**

To create a new admin user manually:

```bash
php artisan make:filament-user
```

---

## Admin Dashboard Features

| Section         | Capabilities                                       |
|-----------------|----------------------------------------------------|
| Profile         | Name, title, bio, images, CV, site settings        |
| Statistics      | Edit hero stats (Years, Projects, Clients)         |
| Social Links    | Add/reorder/delete social media links              |
| Services        | Full CRUD with icons                               |
| Projects        | Full CRUD, thumbnails, categories, URLs            |
| Experience      | Work history with dates                            |
| Education       | Academic background                                |
| Skills          | Skill name + percentage bars                       |
| Products        | Products with pricing and status                   |
| Blog Posts      | Rich text editor, categories, publish/unpublish    |
| Contact Messages| Read, mark as read, delete — unread badge count   |

---

## Uploading Images

All images are stored in `storage/app/public/`.  
After uploading via the admin panel, images are served from `/storage/`.

Ensure you have run `php artisan storage:link` once.

---

## Dark Mode

Click the moon/sun icon in the sidebar (desktop) or top bar (mobile).  
Theme preference is saved to `localStorage` and persists across page reloads.

---

## Project Structure

```
app/
  Filament/
    Resources/         ← All admin CRUD resources
    Widgets/           ← Dashboard stats + recent messages
  Http/
    Controllers/       ← PortfolioController (public)
    Requests/          ← ContactRequest (validation)
  Models/              ← All Eloquent models
  Providers/
    Filament/          ← AdminPanelProvider

database/
  migrations/          ← All 14 table migrations
  seeders/             ← DatabaseSeeder (realistic data)

resources/
  css/app.css          ← Tailwind v4 + design tokens
  js/app.js            ← Theme, sidebar, scroll, filters
  views/
    layouts/app.blade.php
    components/sidebar.blade.php
    portfolio/
      index.blade.php  ← Full single-page portfolio
      blog-show.blade.php

routes/web.php         ← Public routes (/, /blog/{slug}, /contact)
```

---

## Environment Variables

Key settings in `.env`:

```env
APP_NAME="Hukum Roka Portfolio"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_DATABASE=portfolio_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## Production Deployment Checklist

- [ ] Set `APP_ENV=production` and `APP_DEBUG=false`
- [ ] Set `APP_URL` to your real domain
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Run `npm run build`
- [ ] Change the admin password
- [ ] Upload your profile image, CV, and project thumbnails
- [ ] Update all social links in the admin panel

---

## License

Personal portfolio — all rights reserved by Hukum Roka.
