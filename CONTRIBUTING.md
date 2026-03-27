# Contributing to Laravel Auth

Thank you for considering contributing to Laravel Auth!

## Development Setup

```bash
git clone https://github.com/jeremykenedy/laravel-auth.git
cd laravel-auth
git checkout v13-modern

# Install dependencies
composer install
npm install
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate
php artisan db:seed

# Build assets
npm run build

# Or interactive setup
php artisan auth:setup
```

## Architecture

This project uses 23 composable packages in `packages/` (gitignored, composer path repos).

**Critical Rules:**
- Never mix CSS frameworks in the same file (see `notes/VIEW_RULES.md`)
- Tailwind views use ZERO Bootstrap classes
- Bootstrap views use ZERO Tailwind classes
- Blade views use Alpine.js, NOT Livewire directives
- All UI elements use `<x-ui::*>` components from `laravel-ui-kit`

## Running Tests

```bash
# Create test database
mysql -u root -h 127.0.0.1 -e "CREATE DATABASE IF NOT EXISTS modern_test;"

# Run tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test file
php artisan test --filter=AuthenticationTest
```

## Code Style

```bash
# Check style
vendor/bin/pint --test

# Fix style
vendor/bin/pint
```

## Adding a New Feature

1. Read `notes/ARCHITECTURE.md` and `notes/VIEW_RULES.md`
2. Create views for ALL 3 CSS frameworks (Tailwind, BS5, BS4)
3. Create Livewire, Vue, React, Svelte variants
4. Write Pest tests
5. Run `php artisan test` and `vendor/bin/pint`
6. Submit a PR

## Package Development

Each package in `packages/` is a standalone composer package:

```bash
# Create a new package
mkdir -p packages/laravel-myfeature/{src,config,routes,resources,tests,database}

# Wire it up in root composer.json repositories + require
```

See existing packages for the standard structure.
