# Changelog

## v13.0.0 - Laravel 13 Modernization

### Architecture
- Decomposed monolithic app into 23 composable packages
- Multi-framework support: Blade, Livewire 3, Vue 3, React, Svelte
- Multi-CSS support: Tailwind v4, Bootstrap 5, Bootstrap 4
- 24 reusable UI components via `<x-ui::*>` from laravel-ui-kit
- CSS framework separation enforced by architecture tests
- Interactive setup: `php artisan auth:setup`

### New Packages
- `laravel-ui-kit` - 24 Blade components, 7 framework variants each
- `laravel-profiles` - User profiles, avatars, Gravatar, GDPR export
- `laravel-socialite-kit` - 22 OAuth providers, admin GUI
- `laravel-themes` - 22 Bootswatch themes, CSS variable accents
- `laravel-posts` - Blog system with draft/published/archived
- `laravel-captcha` - reCAPTCHA v2/v3
- `laravel-ip-capture` - IP tracking trait
- `laravel-face-auth` - Browser facial recognition
- `laravel-auth-api` - REST API with Sanctum
- `laravel-toast` - Toast notifications
- `laravel-notifications` - In-app notification center
- `laravel-chat` - iMessage-style real-time chat
- `laravel-observability` - Health checks, Sentry/Bugsnag
- `laravel-native-kit` - NativePHP bridge
- `laravel-seedster` - Laravel 13 seedster replacement

### New Features
- TOTP/Google Authenticator two-factor authentication
- User impersonation with indicator bar
- Browser sessions management
- Admin app settings (key-value store)
- Admin dashboard with stats and quick actions
- Dark mode (Light/Dark/System) persisted to database
- Blog/posts system with admin CRUD
- Notification bell with unread count
- User search with live AJAX
- Data export (GDPR compliance)
- Face authentication enrollment
- Per-package install commands

### Updated Packages (widened to Laravel 13)
- `laravel-roles` - RBAC (now with Tailwind + BS5 views)
- `laravel-blocker` - IP blocking (now with Tailwind + BS5 views)
- `laravel-logger` - Activity logging (now with Tailwind + BS5 views)
- `laravel-phpinfo` - PHP info page (now with Tailwind view)
- `laravel2step` - Two-step verification (now with TOTP support)
- `laravel-exception-notifier` - Exception emails
- `laravel-email-database-log` - Email logging
- `laravel-users` - User management CRUD

### Removed
- Bootstrap 4 as default CSS (replaced by Tailwind v4)
- jQuery (replaced by Alpine.js)
- Dropzone.js (replaced by native file upload with Alpine.js)
- DataTables jQuery plugin (replaced by Alpine.js search/filter)
- Old activation system (replaced by MustVerifyEmail)
- `eklundkristoffer/seedster` (replaced by `laravel-seedster`)

### Stats
- 209 routes, 132 tests, 522 frontend files
- 23 packages, 24 UI components
- Zero CSS framework mixing in any file
