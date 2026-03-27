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
