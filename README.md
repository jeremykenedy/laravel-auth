# Laravel Auth

**A modular Laravel 13 authentication and admin platform assembled from 23 composable packages.**

[![Tests](https://github.com/jeremykenedy/laravel-auth/actions/workflows/laravel.yml/badge.svg)](https://github.com/jeremykenedy/laravel-auth/actions)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![GitHub Stars](https://img.shields.io/github/stars/jeremykenedy/laravel-auth?style=social)](https://github.com/jeremykenedy/laravel-auth/stargazers)

[![Sponsor me on GitHub](https://img.shields.io/static/v1?label=Sponsor&message=%E2%9D%A4&logo=GitHub&color=%23fe8e86)](https://github.com/sponsors/jeremykenedy)
[![Buy me a Coffee](https://img.shields.io/badge/Buy_Me_A_Coffee-FFDD00?style=flat&logo=buy-me-a-coffee&logoColor=black)](https://www.buymeacoffee.com/jeremykenedy)

## About

Laravel Auth is a thin root shell that assembles 23 independently publishable Composer packages into a full-featured authentication, user management, and admin platform. Each package follows SOLID, DDD, and Repository patterns with PHP 8.4 enums, action classes, and service layers.

**Tech Stack:** Laravel 13.2 | PHP 8.4 | Tailwind v4 | Alpine.js (via Livewire 3) | Vite 8 | MySQL

**Multi-Frontend:** Blade + Livewire 3 + Vue 3 + React + Svelte
**Multi-CSS:** Tailwind v4 (primary) + Bootstrap 5 + Bootstrap 4

## Features

### Authentication & Authorization
- Email/password registration with MustVerifyEmail
- Login with remember me, rate limiting (5 attempts)
- Password reset via email token
- Password confirmation page
- Social OAuth login (Google, GitHub, Facebook, Twitter + 18 more configurable providers)
- Role-based access control with levels and permissions (4 default roles: Super Admin, Admin, User, Unverified)
- Blade directives: `@role`, `@permission`, `@level`
- Optional two-step verification
- Optional reCAPTCHA/hCaptcha protection

### User Management
- Full admin CRUD (create, show, edit, update, delete)
- Soft deletes with restore and permanent delete
- IP capture on signup, admin actions, and deletion
- User search
- User impersonation (admin can impersonate non-admin users with indicator bar)
- Deleted users management panel

### User Profiles
- Profile show page (bio, location, Twitter, GitHub links)
- Profile edit with live avatar upload (drag-and-drop with preview)
- Gravatar fallback
- Account settings (name, email)
- Password change
- Browser sessions management (list active sessions, log out other devices)
- Dark mode preference (Light/Dark/System, persisted to DB)
- Data export (JSON download)
- Account deletion with restoration option

### Admin Dashboard
- Stats cards (total users, verified, active sessions, deleted)
- Recently active users panel with online indicators
- Application settings page (key-value store with grouped UI)
- Route listing with color-coded HTTP methods
- Activity logging with admin viewer
- IP/domain/user blocking (CRUD + soft deletes)
- Roles and permissions management GUI
- Theme management (22 Bootswatch themes)
- Social provider management (toggle providers on/off)
- Posts/Blog management (full CRUD)

### Blog
- Public blog index with pagination
- Individual post pages with author info and read time
- Admin CRUD with draft/published/archived status
- Auto-generated slugs and excerpts

### Themes
- 22 themes (Default + 21 Bootswatch)
- User theme selection with color swatch previews
- CSS variable accent colors for Tailwind mode
- Bootswatch CDN for Bootstrap 5 mode
- Theme CSS injected via ViewComposer

### Notifications & Toasts
- In-app notification system with bell icon and unread count
- Toast notifications on all actions (auto-converted from flash messages)
- Notification CRUD API

### Monitoring & Security
- Activity logging (all user actions)
- IP/domain/email blocking middleware
- Exception email notifications
- Email database logging
- Health check endpoint (`/health`)
- Sentry.io integration option
- Google Analytics integration via app settings
- Laravel Debugbar (dev)

## Package Ecosystem (23 packages)

| Package | Purpose |
|---|---|
| `laravel-ui-kit` | 22 Blade components (`<x-ui::*>`) for TW/BS5/BS4 + Livewire + Vue + React + Svelte |
| `laravel-roles` | RBAC with roles, permissions, levels, middleware, Blade directives |
| `laravel-profiles` | User profiles, avatars, Gravatar, sessions, data export, account deletion |
| `laravel-themes` | Theme management, Bootswatch integration, CSS variable system |
| `laravel-socialite-kit` | Social auth with 22 OAuth providers, admin GUI, connected accounts |
| `laravel-posts` | Blog/posts system with CRUD, status enum, slug generation |
| `laravel-captcha` | hCaptcha/reCAPTCHA v2/v3 protection |
| `laravel-ip-capture` | Signup/login/action IP tracking |
| `laravel-face-auth` | Face authentication (enrollment, verification, liveness) |
| `laravel-auth-api` | REST API auth (Sanctum) with register/login/logout/reset |
| `laravel-toast` | Toast notification system (session-based, auto-dismiss) |
| `laravel-notifications` | In-app notification CRUD with API |
| `laravel-chat` | Real-time chat (conversations, messages, reactions) |
| `laravel-observability` | Health checks, Sentry/Bugsnag/Datadog integration |
| `laravel-native-kit` | NativePHP desktop/mobile support |
| `laravel-blocker` | IP/domain/email blocking with admin GUI |
| `laravel-logger` | Activity logging with admin viewer |
| `laravel-exception-notifier` | Exception email notifications |
| `laravel-phpinfo` | PHP info page for admins |
| `laravel2step` | Two-step email verification |
| `laravel-users` | User management CRUD helpers |
| `laravel-email-database-log` | Email database logging |
| `laravel-seedster` | Drop-in seedster for Laravel 13 |

## Quick Start

```bash
# Clone
git clone https://github.com/jeremykenedy/laravel-auth.git
cd laravel-auth
git checkout v13-modern

# Install
composer install
npm install
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate
php artisan db:seed

# Build
npm run build

# Interactive setup (pick your CSS + frontend framework)
php artisan auth:setup

# Serve (or use Laravel Herd)
php artisan serve
```

The `auth:setup` command lets you choose:
- **CSS Framework:** Tailwind v4, Bootstrap 5, or Bootstrap 4
- **Frontend Framework:** Blade/Alpine.js, Livewire 3, Vue 3, React, or Svelte
- **Features:** Social auth, 2FA, face auth, captcha, chat (each togglable)

### Default Users

| Email | Password | Role | Level |
|---|---|---|---|
| superadmin@superadmin.com | password | Super Admin | 10 |
| admin@user.com | password | Admin | 5 |
| user@user.com | password | User | 1 |
| unverified@user.com | password | Unverified | 0 |

## Configuration

### Environment Variables

Key settings in `.env`:

```env
# Social Providers (enable the ones you need)
SOCIALITE_GOOGLE_ENABLED=true
SOCIALITE_GITHUB_ENABLED=true
SOCIALITE_FACEBOOK_ENABLED=true
SOCIALITE_TWITTER_ENABLED=true

# OAuth credentials (required for enabled providers)
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=

# Optional features
CAPTCHA_ENABLED=false
FACE_AUTH_ENABLED=false
SENTRY_ENABLED=false
SENTRY_LARAVEL_DSN=
```

### Session Driver

The app uses the `database` session driver for browser session management:

```env
SESSION_DRIVER=database
```

### Mail

Set `MAIL_MAILER=log` for development or configure SMTP for production:

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@example.com
```

## Testing

```bash
# Create test database
mysql -u root -h 127.0.0.1 -e "CREATE DATABASE IF NOT EXISTS modern_test;"

# Run tests (115 passing)
php artisan test

# Code style
vendor/bin/pint --test
```

## Architecture

The root application is a thin shell. All features live in packages under `packages/` (gitignored, composer path repos):

```
laravel-auth/
  app/                  # Thin controllers, models, seeders
  packages/             # 23 composable packages (gitignored)
  resources/views/      # Root views using <x-ui::*> components
  routes/web.php        # Thin route file (packages register their own)
```

**Key conventions:**
- Package controllers extend `Illuminate\Routing\Controller` (not `App\Http\Controllers\Controller`)
- Admin access uses `level:5` middleware (not `role:admin`) so both Admin and Super Admin pass
- Dark mode is class-based (`@custom-variant dark`), not `prefers-color-scheme`
- `<x-ui::*>` components via `Blade::componentNamespace()` from `laravel-ui-kit`
- CSS framework selected via `config('ui-kit.css_framework')` with Tailwind fallback

## Routes

209 routes across all packages. Key route groups:

| Path | Access | Features |
|---|---|---|
| `/` | Public | Welcome, terms, blog |
| `/login`, `/register` | Guest | Auth with social buttons |
| `/home` | Verified | User dashboard |
| `/profile/*` | Auth | Profile, sessions, dark mode, export |
| `/users/*` | Level 5+ | User CRUD, deleted users |
| `/admin/*` | Level 5+ | Themes, posts, social providers |
| `/settings` | Level 5+ | App settings |
| `/activity` | Level 5+ | Activity logs |
| `/blocker` | Level 5+ | IP/domain blocking |
| `/roles`, `/permissions` | Level 5+ | RBAC management |
| `/themes` | Auth | Theme selector |
| `/notifications` | Auth | Notifications |
| `/health` | Public | Health check |
| `/api/v1/*` | API (Sanctum) | REST API |

## License

[MIT License](LICENSE)

## Credits

- [Jeremy Kenedy](https://github.com/jeremykenedy)
- [All Contributors](../../contributors)
