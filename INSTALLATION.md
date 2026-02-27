# Laravel Auth — Installation Guide

A step-by-step guide for setting up **Laravel Auth** on **XAMPP (localhost)** or any standard LAMP/LEMP server.

---

## Requirements

| Requirement | Minimum Version |
|---|---|
| PHP | 8.1+ |
| MySQL | 5.7+ / MariaDB 10.4+ |
| Composer | 2.x |
| Node.js + npm | 18.x+ |
| XAMPP | 8.x (with PHP 8.1+) |

---

## Quick Start (XAMPP)

### 1. Clone the Repository

```bash
cd C:\xampp\htdocs
git clone https://github.com/jeremykenedy/laravel-auth.git laravel-auth
cd laravel-auth
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies & Build Assets

```bash
npm install
npm run dev        # development build
# or
npm run build      # production build
```

### 4. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and update these values:

```dotenv
APP_NAME="Laravel Auth"
APP_URL=http://localhost/laravel-auth/public

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_auth   # create this database in phpMyAdmin first
DB_USERNAME=root
DB_PASSWORD=               # leave empty for default XAMPP
```

> **Tip:** For email verification during development, set `MAIL_MAILER=log`.  
> Emails will be written to `storage/logs/laravel.log` instead of being sent.

### 5. Create the Database

Open **phpMyAdmin** (`http://localhost/phpmyadmin`) and create a new database named `laravel_auth` (utf8mb4_unicode_ci collation).

### 6. Run Migrations & Seed Data

```bash
php artisan migrate --seed
```

This creates all tables and seeds:
- Default roles (admin, user, unverified)
- Default permissions
- A demo admin user
- Theme options

### 7. Configure Storage Link

```bash
php artisan storage:link
```

### 8. Set Folder Permissions (Linux/Mac only)

```bash
chmod -R 775 storage bootstrap/cache
```

### 9. Access the Application

| Method | URL |
|---|---|
| XAMPP (Apache) | `http://localhost/laravel-auth/public` |
| Artisan Dev Server | `php artisan serve` → `http://localhost:8000` |

---

## Default Login Credentials

After seeding, you can login with:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@admin.com` | `password` |
| User | `user@user.com` | `password` |

> **Important:** Change these passwords immediately after first login.

---

## Key Features

- ✅ Email registration with activation
- ✅ Strong password policy (8+ chars, mixed case, number, symbol)
- ✅ Forgot / Reset password
- ✅ Remember Me
- ✅ Logout with session invalidation + confirmation
- ✅ Social authentication (Google, Facebook, Twitter, GitHub, etc.)
- ✅ Two-step verification (optional, off by default)
- ✅ Roles & Permissions system
- ✅ User profile with avatar
- ✅ Admin panel (user management, themes, logs)
- ✅ IP address tracking
- ✅ Laravel Blocker (block IPs / users)
- ✅ reCAPTCHA support

---

## Environment Variables Reference

### Core Settings

```dotenv
ACTIVATION=true                  # Require email activation
ACTIVATION_LIMIT_TIME_PERIOD=24  # Hours before activation link expires
ACTIVATION_LIMIT_MAX_ATTEMPTS=3  # Max activation attempts before lockout
```

### Two-Step Auth

```dotenv
LARAVEL_2STEP_ENABLED=false      # Enable two-step verification
```

### Social Login (Socialite)

Configure OAuth credentials from each platform's developer console:

```dotenv
GOOGLE_ID=your-google-client-id
GOOGLE_SECRET=your-google-secret
GOOGLE_REDIRECT=http://localhost:8000/social/handle/google

GITHUB_ID=your-github-id
GITHUB_SECRET=your-github-secret
GITHUB_URL=http://localhost:8000/social/handle/github
```

### reCAPTCHA

```dotenv
ENABLE_RECAPTCHA=true
RE_CAP_SITE=your-recaptcha-site-key
RE_CAP_SECRET=your-recaptcha-secret-key
```

---

## Useful Artisan Commands

```bash
# Clear all caches
php artisan optimize:clear

# View all registered routes
php artisan route:list

# Run tests
php artisan test

# Reset and re-seed database (⚠️ destroys data)
php artisan migrate:fresh --seed
```

---

## Password Policy

Passwords must meet **all** of the following requirements:

- Minimum **8 characters**
- At least one **uppercase** letter (A–Z)
- At least one **lowercase** letter (a–z)
- At least one **number** (0–9)
- At least one **symbol** (e.g., `!@#$%`)
- Must not be a [known breached password](https://haveibeenpwned.com/Passwords)

---

## Troubleshooting

**"Class not found" errors**  
```bash
composer dump-autoload
```

**"No application encryption key" error**  
```bash
php artisan key:generate
```

**Blank page / 500 error**  
Check `storage/logs/laravel.log` for details and ensure `APP_DEBUG=true` in `.env`.

**Assets not loading**  
```bash
npm run build
```

**Session/cookie issues**  
Ensure `APP_URL` in `.env` exactly matches the URL you're visiting.

---

## Security Hardening for Production

Before deploying:

```dotenv
APP_ENV=production
APP_DEBUG=false
```

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## License

MIT License — see [LICENSE](LICENSE) file for details.
