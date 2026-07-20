# Sri Vayaluran Herbals — Laravel Edition

A full Laravel 13 rebuild of the shop's site: public homepage + admin panel,
backed by MySQL/Eloquent instead of flat JSON files. Project folder on disk:
`C:\xampp\htdocs\SriVayaluranHerbals`. Local DB name: `sri_vayaluran`.

> **Note:** this was originally built on Laravel 10, but Laravel 10 (and 11)
> are now end-of-life and no longer receive security patches — that's what
> Composer's advisory check was warning you about. The app now targets
> **Laravel 13** (PHP 8.3+), which is the currently supported release. It
> uses Laravel 11+'s streamlined app structure, so there's no `app/Http/Kernel.php`,
> `app/Console/Kernel.php`, or `app/Exceptions/Handler.php` — all of that now
> lives in `bootstrap/app.php`.

> This file exists so a fresh Claude chat (or any dev) can get full context
> fast, without re-explaining the project from scratch. Keep it updated as
> features are added.

---

## What changed from the plain-PHP version

- **Real database** — categories, products, product pack-size/price variants,
  and reviews are now MySQL tables via Eloquent models & migrations, not JSON files.
- **Real authentication** — the admin login now uses Laravel's session-based
  `Auth` system (hashed password, CSRF-protected forms) instead of a literal
  string comparison. The seeded credentials still match what you asked for:
  **username: `admin` / password: `admin@123`** (set in `.env`, seeded by
  `AdminUserSeeder`).
- **Server-rendered homepage** — the "Remedies We Still Make By Hand" section
  and testimonial carousel are rendered directly by Blade from the database
  (still capped at 5 products per category), so there's no separate Ajax/API
  call needed anymore — that's baked into how Laravel/Blade works.
- Image uploads go through Laravel's Storage facade onto the `public` disk.

---

## First-time setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your MySQL credentials (`DB_DATABASE`, `DB_USERNAME`,
`DB_PASSWORD`). Change `ADMIN_USERNAME` / `ADMIN_PASSWORD` there too if you
don't want the defaults.

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

Visit `http://localhost:8000` for the homepage and
`http://localhost:8000/admin/login` for the admin panel.

**If you're pulling the Combo Packs feature for the first time**, also run:

```bash
composer require doctrine/dbal   # needed for a nullable-column migration
php artisan migrate
php artisan route:clear
php artisan optimize:clear
```

---

## Project structure

```
app/Models/               Category, Product, ProductVariant, Review, User,
                           Combo, ComboItem
app/Http/Controllers/     HomeController (public), ComboController (public),
                           Admin/* (admin panel, incl. Admin/ComboController)
database/migrations/      categories, products, product_variants, reviews,
                           users, combos, combo_product
database/seeders/         AdminUserSeeder, CategorySeeder, ReviewSeeder
resources/views/
  home.blade.php           public homepage (incl. combo banner carousel)
  combos/show.blade.php    public combo detail page
  admin/                   admin panel views (incl. admin/combos/*)
  layouts/admin.blade.php  admin sidebar layout
routes/web.php             all routes (public + admin, grouped)
public/css/admin.css       admin panel styling
```

---

## Stack / conventions

- Laravel 13, streamlined app structure (no `Kernel.php` — middleware config
  lives in `bootstrap/app.php`).
- Blade + Bootstrap classes on the **public** site (`layouts/app.blade.php`).
- Custom themed admin UI on the **admin** side (`layouts/admin.blade.php`),
  using its own CSS with classes: `page-head`, `card`, `form-grid`,
  `field` / `field full`, `variant-row`, `btn btn-gold` / `btn-outline` /
  `btn-danger`, `data-table`, `badge badge-success` / `badge badge-muted`.
  **Always match this class naming when adding new admin screens** — don't
  invent new one-off classes/styles.
- Admin routes are grouped under `Route::prefix('admin')->name('admin.')`,
  so **every admin route name is prefixed** — e.g. `admin.combos.index`,
  `admin.products.store`. Public routes are unprefixed — e.g. `combos.show`.
- Admin auth uses Laravel's session-based `Auth` (hashed password,
  CSRF-protected). Seeded admin credentials: `admin` / `admin@123` (via
  `.env` + `AdminUserSeeder`).

---

## Notes (general)

- Tamil category/product names were left blank in the seeders on purpose —
  fill in real translations through the admin panel rather than guessed
  placeholders.
- Each product can have multiple pack sizes/prices (e.g. 100 gms — ₹80,
  250 gms — ₹200) via the `product_variants` table; the product form has an
  "Add Pack Size" button for this.
- Deleting a category is blocked while it still has products, same as before.
- The homepage still shows a "Showing 5 of 12 — more available in-store" note
  when a category has more than 5 products.

---

## Combo Packs feature

**What it is:** curated bundles of items sold at their own combo price,
shown as an auto-scrolling banner carousel on the homepage. Clicking a
banner opens a combo detail page.

### Key design decision: combo items can be real products OR manual text

A combo item does **not** have to correspond to a row in the `products`
table. E.g. "Roja Poo" isn't sold as a standalone product but needs to be
listed inside a combo. So each combo item is **either**:
- linked to a real `Product` (via `product_id`), **or**
- a free-typed name (`custom_name` / `custom_name_ta`), with `product_id`
  null.

This is why the pivot ended up as its own real Eloquent model
(`ComboItem`) instead of a plain `belongsToMany` pivot — a `belongsToMany`
does an inner join to `products`, which would silently hide any row where
`product_id` is null. **Do not refactor this back to `belongsToMany`
without re-solving that problem.**

### Database

**`combos` table**
| column | notes |
|---|---|
| `title`, `title_ta` | combo name, English/Tamil |
| `slug` | unique, auto-generated as `slug(title)-uniqid()` |
| `banner_image` | **1248×502** — used in homepage carousel |
| `main_image` | shown on the combo detail page |
| `price` | combo's own price (not auto-summed from items) |
| `description`, `additional_info` | free text |
| `is_active` | boolean — only active combos show on homepage/are viewable |
| `sort_order` | controls carousel/list order |

**`combo_product` table** (via `ComboItem` model, `$table = 'combo_product'`)
| column | notes |
|---|---|
| `combo_id` | FK, cascade delete |
| `product_id` | FK, **nullable** — null means manual item |
| `custom_name`, `custom_name_ta` | used only when `product_id` is null |
| `grams` | required either way |
| `sort_order` | controls item display order within the combo |

Migrations (run in this order):
1. `xxxx_create_combos_table.php`
2. `xxxx_create_combo_product_table.php`
3. `xxxx_modify_combo_product_table_for_custom_items.php` — makes
   `product_id` nullable, adds `custom_name`/`custom_name_ta`. **Requires
   `composer require doctrine/dbal`** since it uses `->change()`.

### Models

- `app/Models/Combo.php` — `hasMany(ComboItem::class)` via `items()`,
  ordered by `sort_order`. No direct `products()` belongsToMany (see design
  note above).
- `app/Models/ComboItem.php` — `$table = 'combo_product'`. `belongsTo(Combo)`,
  `belongsTo(Product)` (nullable). Accessors `name_en` / `name_ta` return
  `custom_name` if set, else fall back to the related product's name.

### Controllers

- `app/Http/Controllers/Admin/ComboController.php` — full CRUD
  (`index/create/store/edit/update/destroy`), resourceful, mounted at
  `admin.combos.*`. `syncItems()` wipes and rebuilds a combo's items on
  every save from the submitted `product_id[]` / `custom_name[]` /
  `custom_name_ta[]` / `grams[]` arrays — a row is kept only if it has a
  `product_id` **or** a `custom_name`.
- `app/Http/Controllers/ComboController.php` (public) — `show()`, 404s if
  `is_active` is false, eager-loads `items.product`.

### Routes (`routes/web.php`)

```php
// public
Route::get('/combos/{combo:slug}', [ComboController::class, 'show'])->name('combos.show');

// admin — inside Route::prefix('admin')->name('admin.') -> auth middleware group
Route::resource('combos', ComboController::class);
// generates: admin.combos.index / .create / .store / .edit / .update / .destroy
```

⚠️ **Gotcha already hit once:** the combo resource route was originally
placed inside the `guest` middleware sub-group by mistake, which caused
`/admin/combos` to redirect to home for logged-in admins. It must live in
the `auth` middleware sub-group, alongside `categories`/`products`.

### Views

- `resources/views/admin/combos/index.blade.php` — listing table, styled
  to match `admin/products/index.blade.php` (`data-table`, `badge-*`).
- `resources/views/admin/combos/form.blade.php` — create/edit form, styled
  to match `admin/products/form.blade.php` (`page-head`, `card`,
  `form-grid`, `field`/`field full`). Item rows (`.combo-item-row`) each
  have: product `<select>`, manual English name, manual Tamil name, grams,
  remove button. JS disables the manual-name inputs automatically when a
  product is selected in that row (`toggleManualFields()`), and vice versa,
  so admins can't fill both for one row.
- `resources/views/combos/show.blade.php` — public detail page. Loops
  `$combo->items` (not `$combo->products`) and reads `$item->name_en` /
  `$item->name_ta` / `$item->grams` — this works transparently for both
  real-product items and manual items via the accessors on `ComboItem`.
- Homepage carousel (`resources/views/home.blade.php`) — reads
  `$combos = Combo::where('is_active', true)->orderBy('sort_order')->get()`
  (added in `HomeController@index`), renders a Bootstrap carousel with
  indicators + prev/next controls, each slide linking to
  `route('combos.show', $combo->slug)`. Banner images are constrained via
  CSS `aspect-ratio: 1248 / 502; object-fit: cover;` to stay consistent
  even if an admin uploads a slightly different size.

Add a **Combo Packs** link to the admin sidebar (`layouts/admin.blade.php`)
pointing at `route('admin.combos.index')`, next to Categories/Products/Reviews,
if not already added.

---

## Known environment quirks (from this project, not generic Laravel)

- Windows + XAMPP + PowerShell. MySQL via phpMyAdmin at
  `http://localhost/phpmyadmin`.
- A stray pre-existing migration (`add_slug_to_products_table`) once
  conflicted with a manually-added `slug` column — fixed by wrapping its
  `up()` in `if (!Schema::hasColumn(...))`. If similar "column already
  exists" errors show up again, check `php artisan migrate:status` first
  before assuming the migration file is wrong.
- There's a one-off maintenance route in `web.php`,
  `GET /fix-slugs-now`, that regenerates slugs for all products. It's a
  manual utility route, not part of normal app flow — remove before going
  to production.

---

## Next planned feature (not started yet)

**Related products** — after a customer views a product or combo, show
"related" items (likely same-category products, or manually curated
relations). Not yet designed — discuss data model (auto by category vs.
explicit admin-curated links) before implementing.
