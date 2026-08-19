# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

WordPress plugin that adds a single "Hero" module (`alingsashero`) to the Modularity module system used by Municipio-based sites (Consid Borås AB / Alingsås Kommun). It is **not** a standalone plugin — it registers itself into a parent WordPress install that already has the Modularity plugin, the Municipio theme, ACF, and the Component Library (blade view engine) active. Classes like `\Modularity\Module`, `\Modularity\Helper\FormatObject`, `\ComponentLibrary\Init`, and `\AcfExportManager\AcfExportManager` are provided by that parent site at runtime — they are not vendored here (`composer.lock` has zero packages; `vendor/autoload.php` only provides this plugin's own PSR-4 autoloading for the `AlingsasHero\` namespace).

## Commands

```bash
npm install                # install JS/Sass build tooling
npm run dev                # vite dev server
npm run build               # production build → dist/ (+ manifest.json)
npm run build:dev           # development-mode build (unminified)
npm run watch                # rebuild on change, development mode
npm run make-pot            # regenerate languages/modularity-alingsashero.pot (requires wp-cli)
composer install            # sets up the psr-4 autoloader (no external runtime deps)
php build.php               # full CI-style build: npm install, update browserslist db, npm run build, composer install
php build.php --cleanup     # same, then strips dev-only files (.git, node_modules, composer/package files, etc.) for a prod artifact
```

There is no test suite and no linter configured in this repo.

Frontend assets are built with Vite via the shared `vite-config-factory` package (`vite.config.mjs`). Entry points are `source/sass/modularity-alingsashero.scss` and `source/js/modularity-alingsashero.js` (currently empty — JS enqueue is commented out, see below), compiled to `dist/css` / `dist/js` with a `dist/manifest.json` for cache-busted filenames.

## Architecture

**Bootstrap (`modularity-alingsashero.php`)**: defines path/URL constants (`ALINGAS_HERO_*`), loads the plugin textdomain, requires the autoloader and `Public.php`, wires the ACF field group auto-export/import (`AcfExportManager`) for the `module` group, registers the module's view path with Modularity 3.0's component library (`/Modularity/externalViewPath` filter), and instantiates `AlingsasHero\App`.

**`App.php`**: on `init`, calls `modularity_register_module()` (a Modularity plugin function) to register the module class at `ALINGAS_HERO_MODULE_PATH`. Also hooks `Municipio/blade/view_paths` to insert `ALINGAS_HERO_VIEW_PATH` into the blade template search path (inserted after the child-theme path if a child theme is active, otherwise first).

**Module (`source/php/Module/alingsashero.php`)**: `AlingsasHero\Module\alingsashero extends \Modularity\Module`. This is the actual module logic, following Modularity's module contract:
- `init()` — sets name/description (translated strings)
- `data()` — pulls ACF fields via `get_fields()`, camelCases them (`\Modularity\Helper\FormatObject::camelCase`), and builds the RekAI recommendation payload (clamps `numberOfRecommendations` to 0–7, generates a unique container id, builds a comma-separated excluded-permalink list via `createExcludeTree()` combining an ACF post-object field and a free-text textarea of links)
- `template()` — returns the blade view filename
- `style()` / `script()` — conditionally enqueue compiled assets from `dist/` using `Helper\CacheBust::name()` to resolve hashed filenames from the Vite manifest (JS enqueue is currently commented out since `modularity-alingsashero.js` is empty)

**ACF fields (`source/php/AcfFields/`)**: `php/module.php` registers the field group in code (`acf_add_local_field_group`); `json/module.json` is the ACF JSON sync counterpart. These are kept in sync automatically by `AcfExportManager` (see bootstrap file) — when editing fields in wp-admin, the JSON is the source of truth for sync and the PHP file should be regenerated/kept matching it (`acfe_autosync` is set to `json`).

**View (`source/php/Module/views/alingsashero.blade.php`)**: Blade template rendered through the Component Library engine (also usable standalone via the `modularity_alingsashero_render_blade_view()` helper in `Public.php`). Uses Municipio/Component Library blade directives (`@typography`, `@form`, `@field`, `@button`, `@group`) — this is not plain Blade, it depends on directives registered by the parent theme/component library. The template also contains an inline `<script>` for the RekAI recommendation widget: it listens for `pressidium-cookie-consent-accepted` / `-changed` events to reveal the recommendation buttons only once analytics consent is granted, then listens for a global `rekai.load` event to call `window.__rekai.predict(...)` and render returned predictions as buttons.

**Admin (`source/php/Admin/Settings.php`)**: scaffolding for an ACF options sub-page; currently a no-op (the `acf/init` hook registration is commented out).

## Key conventions

- Namespace root `AlingsasHero\` maps to `source/php/` (PSR-4, see `composer.json`).
- Version number must be kept in sync across three places when bumping: `modularity-alingsashero.php` (plugin header `Version:`), `package.json`, and `composer.json`.
- RekAI feature is gated by two ACF Options fields not defined in this repo (`rekai_enable`, `rekai_script_url`) — they belong to the parent site/theme's options page.
- Excluded-link permalinks are stripped of `home_url()` before being sent to RekAI to avoid CORS issues with absolute URLs.
