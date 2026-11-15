# Deployment Guide

Laravel 12 · PHP 8.2+ · MySQL · Filament 3 · Vite + Tailwind CSS 4

---

## Requirements

| Requirement | Minimum |
|---|---|
| PHP | 8.2 |
| Extensions | BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML |
| MySQL | 5.7 / 8.0+ (or MariaDB 10.3+) |
| Node.js | 18+ (build step only, not needed on server) |
| Composer | 2.x |
| Web server | Apache (mod_rewrite) or Nginx |

---

## Option A — Shared Hosting (cPanel / Plesk)

Shared hosting requires you to build assets locally first, then upload.

### 1. Build assets on your local machine

```bash
npm install
npm run build
```

This produces the `public/build/` folder. Include it in your upload.

### 2. Upload files

Upload **everything except** the following — they must stay off the public web:

```
.git/
node_modules/
storage/logs/
.env          ← create this directly on the server
```

Point your domain's **Document Root** to the `public/` subdirectory, not the project root.
Most cPanel hosts let you do this under *Domains → Manage → Document Root*.

If your host does not allow changing the document root, move the contents of `public/` into
`public_html/` and edit `public_html/index.php` — change the two `__DIR__` paths to point
one level up to your project root:

```php
// public_html/index.php
require __DIR__.'/../MyPortfolio/vendor/autoload.php';
$app = require_once __DIR__.'/../MyPortfolio/bootstrap/app.php';
```

### 3. Create the database

Create a MySQL database and user via cPanel → *MySQL Databases*, then note the credentials.

### 4. Create .env on the server

Copy `.env.example` to `.env` via the File Manager or SSH, then fill in your values:

```
APP_NAME="Your Name"
APP_ENV=production
APP_KEY=                        ← generate below
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.yourprovider.com
MAIL_PORT=587
MAIL_USERNAME=you@yourdomain.com
MAIL_PASSWORD=your_mail_password
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 5. Run setup commands via SSH (or cPanel Terminal)

```bash
# Install PHP dependencies (production only, no dev packages)
composer install --no-dev --optimize-autoloader

# Generate application key
php artisan key:generate

# Run all database migrations
php artisan migrate --force

# Create the public storage symlink
php artisan storage:link

# Cache everything for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan filament:cache-components
php artisan optimize
```

If your host does not provide SSH, use the cPanel **Terminal** tool or a PHP-based runner.

---

## Option B — VPS / Cloud Server (Ubuntu + Nginx)

### 1. Server setup (one time)

```bash
# Install dependencies
sudo apt update && sudo apt install -y nginx mysql-server php8.2-fpm \
  php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip \
  php8.2-bcmath php8.2-gd php8.2-intl unzip curl git

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 2. Clone the repository

```bash
cd /var/www
git clone https://github.com/your-username/your-repo.git portfolio
cd portfolio
```

### 3. Configure Nginx

Create `/etc/nginx/sites-available/portfolio`:

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/portfolio/public;

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

```bash
sudo ln -s /etc/nginx/sites-available/portfolio /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

### 4. HTTPS with Let's Encrypt

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 5. Set up the application

```bash
cp .env.example .env
# Edit .env with your values
nano .env

composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link

# Fix permissions
sudo chown -R www-data:www-data /var/www/portfolio
sudo chmod -R 755 /var/www/portfolio/storage /var/www/portfolio/bootstrap/cache
```

### 6. Build assets (on your local machine, then upload public/build/)

```bash
npm install && npm run build
# Upload/rsync public/build/ to the server
rsync -avz public/build/ user@yourserver:/var/www/portfolio/public/build/
```

Or install Node on the server and build there:

```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
npm ci && npm run build
```

### 7. Final optimizations

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan filament:cache-components
php artisan optimize
```

---

## Subsequent Deployments (VPS)

After the first deployment, use the built-in Composer script for all future deploys:

```bash
git pull origin main
npm ci && npm run build           # on server if Node is installed, else upload public/build/
composer run deploy
```

`composer run deploy` does the following in order:

1. Installs production Composer dependencies
2. Puts the site into maintenance mode (visitors see a 503 page)
3. Runs any new migrations
4. Re-creates the storage symlink
5. Rebuilds all caches (config, routes, views, icons, Filament components)
6. Runs `artisan optimize`
7. Brings the site back online

If something goes wrong mid-deploy:

```bash
composer run deploy:rollback
```

This clears all caches and brings the site back up immediately.

---

## Environment Variable Reference

| Variable | Production value | Notes |
|---|---|---|
| `APP_ENV` | `production` | Never `local` on a live server |
| `APP_DEBUG` | `false` | Exposes stack traces if `true` |
| `APP_KEY` | generated | Run `php artisan key:generate` |
| `APP_URL` | `https://yourdomain.com` | Must match your actual domain |
| `DB_CONNECTION` | `mysql` | |
| `SESSION_DRIVER` | `database` | Requires `php artisan migrate` |
| `CACHE_STORE` | `database` | Or `redis` if available |
| `QUEUE_CONNECTION` | `sync` | Use `database` or `redis` for async mail |
| `FILESYSTEM_DISK` | `public` | Needed for uploaded images |
| `MAIL_MAILER` | `smtp` | Use `log` only for local testing |
| `LOG_LEVEL` | `error` | Reduces noise; use `debug` only locally |

---

## Filament Admin Panel

The admin panel is available at `/admin`. Create the first admin user with:

```bash
php artisan make:filament-user
```

---

## Troubleshooting

**500 error after deploy**
```bash
php artisan optimize:clear   # clears all caches
php artisan config:cache     # rebuild
```

**Uploaded images not showing**
```bash
php artisan storage:link
```

**Migrations fail**
Check `DB_*` values in `.env` and that the database user has `CREATE`, `ALTER`, `DROP` privileges.

**Blank page / white screen**
Set `APP_DEBUG=true` temporarily to read the error, fix it, then set back to `false`.

**Filament assets not loading**
```bash
php artisan filament:upgrade
php artisan filament:cache-components
```
