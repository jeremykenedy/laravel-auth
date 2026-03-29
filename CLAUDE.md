# CLAUDE.md — Mandatory Instructions for Claude Code
# ============================================================
# THIS FILE IS READ AUTOMATICALLY. FOLLOW EVERY RULE EXACTLY.
# VIOLATION OF THESE RULES WILL BREAK THE APPLICATION.
# ============================================================

## STEP 1: READ THESE FILES BEFORE ANY WORK
Before writing a single line of code, read ALL of these in order:
1. notes/PROJECT_BRIEFING.md — What this project is, current state
2. notes/ARCHITECTURE.md — How the multi-framework system works (READ FULLY)
3. notes/VIEW_RULES.md — MANDATORY rules for writing views (READ TWICE)
4. notes/SESSION_STATE.md — What was fixed, what's broken
5. notes/WORK_LIST.md — Prioritized remaining work

## CHAT HISTORY REFERENCE
notes/CHAT_HISTORY.md (6332 lines, 292KB) contains the FULL exported chat
from the developer who built this project. DO NOT read it all at once.
It will exceed your context window.

USE IT AS REFERENCE: When you need context on WHY a decision was made,
or HOW something was originally implemented, grep or search specific
sections of CHAT_HISTORY.md. Example:
  grep -n "HasTheme" notes/CHAT_HISTORY.md
  grep -n "seedster" notes/CHAT_HISTORY.md
  sed -n '1000,1050p' notes/CHAT_HISTORY.md

The structured docs (ARCHITECTURE.md, VIEW_RULES.md, etc.) are the
DISTILLED version of this chat. Trust them first. Use the chat history
only when you need deeper context.

## STEP 2: UNDERSTAND THE CORE CONCEPT
This app supports 3 CSS frameworks × 5 frontend frameworks = 15 possible
rendering modes. But they are NEVER mixed. At runtime, the app uses exactly
ONE CSS framework and ONE frontend framework, selected by config.

The config values that control this:
  config('ui-kit.css_framework')  → 'tailwind' | 'bootstrap5' | 'bootstrap4'
  config('ui-kit.frontend')       → 'blade' | 'livewire' | 'vue' | 'react' | 'svelte'

Set via .env:
  UI_KIT_CSS=tailwind
  UI_KIT_FRONTEND=blade

## THE SINGLE MOST IMPORTANT RULE
╔══════════════════════════════════════════════════════════════════════╗
║  NEVER MIX FRAMEWORKS IN THE SAME FILE. EVER. NO EXCEPTIONS.      ║
║                                                                      ║
║  A Tailwind view has ZERO Bootstrap classes.                         ║
║  A Bootstrap 5 view has ZERO Tailwind classes.                       ║
║  A Bootstrap 4 view has ZERO Tailwind classes.                       ║
║  A Blade view has ZERO wire: directives (use Alpine.js instead).     ║
║  A Livewire view has ZERO Alpine x-data (use wire: instead).         ║
║  A Vue file has ZERO Blade {{ }} syntax.                             ║
║  A React file has ZERO Blade {{ }} syntax.                           ║
║  A Svelte file has ZERO Blade {{ }} syntax.                          ║
║                                                                      ║
║  If you catch yourself putting a Bootstrap class in a Tailwind file, ║
║  or a Tailwind class in a Bootstrap file, STOP. You are violating    ║
║  the architecture. Each file lives in a directory that determines     ║
║  its framework. Use ONLY that framework's classes.                   ║
╚══════════════════════════════════════════════════════════════════════╝

## SELF-CHECK BEFORE EVERY FILE WRITE
Before writing ANY view file, ask yourself:
1. What directory is this file in? (tailwind/blade? bootstrap5/blade? livewire?)
2. Am I using ONLY that directory's CSS framework?
3. Am I using ONLY that directory's frontend framework?
4. Do I have dark: variants on every Tailwind color class?
5. Do all x-show elements have x-cloak?

If ANY answer is wrong, fix it before writing.

## PROJECT BASICS
- **What**: jeremykenedy/laravel-auth (3.1K stars) monolith → 22 packages
- **Laravel**: 13.2.0 | **PHP**: 8.4.19 | **Branch**: v12-modern
- **Local path**: ~/sites/laravel-auth-modernized
- **Packages**: packages/ dir (gitignored, composer path repos)

## TECH STACK
- Tailwind v4 (primary CSS), Bootstrap 5, Bootstrap 4
- Alpine.js (Blade interactivity), Livewire 3, Vue 3, React 18, Svelte 4
- Vite 8, MySQL (database: modern), Laravel Herd

## COMMANDS
```
npm run build              # Vite build (MUST run after CSS/JS changes)
php artisan view:clear     # Clear compiled views (after Blade changes)
php artisan db:seed        # Run all seeders (MUST pass after schema changes)
php artisan route:list     # Show all routes
php artisan migrate        # Run pending migrations
```

## FRAMEWORK MIXING VIOLATIONS — EXAMPLES

### WRONG — Tailwind view with Bootstrap classes:
```html
<!-- THIS IS WRONG. "card" and "card-body" are Bootstrap. -->
<div class="card">
    <div class="card-body">
        <h5 class="text-lg font-bold">Title</h5>  <!-- Tailwind mixed in -->
    </div>
</div>
```

### RIGHT — Pure Tailwind view:
```html
<div class="rounded-lg border border-gray-200 dark:border-gray-700 p-6">
    <h5 class="text-lg font-bold text-gray-900 dark:text-gray-100">Title</h5>
</div>
```

### WRONG — Blade view with Livewire directives:
```html
<!-- THIS IS WRONG. wire:click is Livewire. This is a Blade view. -->
<button wire:click="save" class="btn btn-primary">Save</button>
```

### RIGHT — Blade view with Alpine.js:
```html
<button @click="submitForm()" class="btn btn-primary">Save</button>
```

### WRONG — Mixing both CSS frameworks:
```html
<!-- THIS IS CATASTROPHICALLY WRONG -->
<div class="card mb-4">                          <!-- Bootstrap -->
    <div class="p-6 rounded-lg shadow-sm">       <!-- Tailwind -->
        <button class="btn btn-primary">Click</button>  <!-- Bootstrap -->
    </div>
</div>
```

## VIEW DIRECTORY STRUCTURE
Each package that has views follows this EXACT structure:
```
packages/{package}/resources/
  views/
    tailwind/blade/         ← Tailwind + Blade views (uses ONLY TW classes)
    bootstrap5/blade/       ← Bootstrap 5 + Blade views (uses ONLY BS5 classes)
    bootstrap4/blade/       ← Bootstrap 4 + Blade views (uses ONLY BS4 classes)
    livewire/               ← Livewire views (uses <x-ui::*> components)
  js/
    vue/pages/              ← Vue SFC components
    react/pages/            ← React components
    svelte/pages/           ← Svelte components
```

The ServiceProvider loads views from the CORRECT CSS directory based on config:
```php
$css = config('ui-kit.css_framework', 'tailwind');
$this->loadViewsFrom(__DIR__ . '/../../resources/views/' . $css . '/blade', 'packagename');
```

## <x-ui::*> COMPONENT SYSTEM
All UI uses <x-ui::*> components from laravel-ui-kit. These components
automatically render the correct CSS variant. When writing Blade views:
- USE: <x-ui::button>, <x-ui::card>, <x-ui::input>, etc.
- The component internally loads the right CSS framework template
- You still need framework-specific classes for LAYOUT (grid, spacing, etc.)
- The layout classes MUST match the directory's CSS framework

## CRITICAL GOTCHAS
1. Existing package controllers extend Illuminate\Routing\Controller, NOT App\Http\Controllers\Controller
2. profiles.theme_id is NULLABLE, NO FK constraint
3. HasTheme goes through profile->theme_id, NOT users.theme_id
4. Dark mode is CLASS-BASED (@custom-variant dark), not prefers-color-scheme
5. All x-show elements MUST have x-cloak
6. [x-cloak] CSS rule must be in app.css AND inline in both layouts
7. db:seed must pass clean after ANY schema change
8. LaravelBlockerServiceProvider uses afterResolving('seed.handler')

## EXISTING BS4 PACKAGES (LEGACY)
These 8 packages have LEGACY Bootstrap 4 views that are NOT yet multi-framework:
- laravel-roles, laravel-blocker, laravel-logger, laravel-phpinfo
- laravel2step, laravel-exception-notifier, laravel-https, laravel-users

Their views live in src/resources/views/ (flat, no CSS framework subdirs).
They use Bootstrap 4 classes. DO NOT add Tailwind to these files.
They will be migrated to the multi-framework structure in a future phase.

## OUTPUT RULES
- Full file contents, not diffs/patches
- Minimal comments in code
- No em dashes or regular dashes in text output
- Always test: npm run build, php artisan view:clear, php artisan db:seed

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.4
- laravel/framework (LARAVEL) - v13
- laravel/horizon (HORIZON) - v5
- laravel/prompts (PROMPTS) - v0
- laravel/reverb (REVERB) - v1
- laravel/sanctum (SANCTUM) - v4
- laravel/socialite (SOCIALITE) - v5
- livewire/livewire (LIVEWIRE) - v3
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- alpinejs (ALPINEJS) - v3
- laravel-echo (ECHO) - v2
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

- `laravel-best-practices` — Apply this skill whenever writing, reviewing, or refactoring Laravel PHP code. This includes creating or modifying controllers, models, migrations, form requests, policies, jobs, scheduled commands, service classes, and Eloquent queries. Triggers for N+1 and query performance issues, caching strategies, authorization and security patterns, validation, error handling, queue and job configuration, route definitions, and architectural decisions. Also use for Laravel code reviews and refactoring existing Laravel code to follow best practices. Covers any task involving Laravel backend PHP code patterns.
- `configuring-horizon` — Use this skill whenever the user mentions Horizon by name in a Laravel context. Covers the full Horizon lifecycle: installing Horizon (horizon:install, Sail setup), configuring config/horizon.php (supervisor blocks, queue assignments, balancing strategies, minProcesses/maxProcesses), fixing the dashboard (authorization via Gate::define viewHorizon, blank metrics, horizon:snapshot scheduling), and troubleshooting production issues (worker crashes, timeout chain ordering, LongWaitDetected notifications, waits config). Also covers job tagging and silencing. Do not use for generic Laravel queues without Horizon, SQS or database drivers, standalone Redis setup, Linux supervisord, Telescope, or job batching.
- `socialite-development` — Manages OAuth social authentication with Laravel Socialite. Activate when adding social login providers; configuring OAuth redirect/callback flows; retrieving authenticated user details; customizing scopes or parameters; setting up community providers; testing with Socialite fakes; or when the user mentions social login, OAuth, Socialite, or third-party authentication.
- `livewire-development` — Use for any task or question involving Livewire. Activate if user mentions Livewire, wire: directives, or Livewire-specific concepts like wire:model, wire:click, invoke this skill. Covers building new components, debugging reactivity issues, real-time form validation, loading states, migrating from Livewire 2 to 3, converting component formats (SFC/MFC/class-based), and performance optimization. Do not use for non-Livewire reactive UI (React, Vue, Alpine-only, Inertia.js) or standard Laravel forms without Livewire.
- `pest-testing` — Use this skill for Pest PHP testing in Laravel projects only. Trigger whenever any test is being written, edited, fixed, or refactored — including fixing tests that broke after a code change, adding assertions, converting PHPUnit to Pest, adding datasets, and TDD workflows. Always activate when the user asks how to write something in Pest, mentions test files or directories (tests/Feature, tests/Unit, tests/Browser), or needs browser testing, smoke testing multiple pages for JS errors, or architecture tests. Covers: it()/expect() syntax, datasets, mocking, browser testing (visit/click/fill), smoke testing, arch(), Livewire component tests, RefreshDatabase, and all Pest 4 features. Do not use for factories, seeders, migrations, controllers, models, or non-test PHP code.
- `echo-development` — Develops real-time broadcasting with Laravel Echo. Activates when setting up broadcasting (Reverb, Pusher, Ably); creating ShouldBroadcast events; defining broadcast channels (public, private, presence, encrypted); authorizing channels; configuring Echo; listening for events; implementing client events (whisper); setting up model broadcasting; broadcasting notifications; or when the user mentions broadcasting, Echo, WebSockets, real-time events, Reverb, or presence channels.
- `tailwindcss-development` — Always invoke when the user's message includes 'tailwind' in any form. Also invoke for: building responsive grid layouts (multi-column card grids, product grids), flex/grid page structures (dashboards with sidebars, fixed topbars, mobile-toggle navs), styling UI components (cards, tables, navbars, pricing sections, forms, inputs, badges), adding dark mode variants, fixing spacing or typography, and Tailwind v3/v4 work. The core use case: writing or fixing Tailwind utility classes in HTML templates (Blade, JSX, Vue). Skip for backend PHP logic, database queries, API routes, JavaScript with no HTML/CSS component, CSS file audits, build tool configuration, and vanilla CSS.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.
- To check environment variables, read the `.env` file directly.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== tests rules ===

# Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test --compact` with a specific filename or filter.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== livewire/core rules ===

# Livewire

- Livewire allow to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>
