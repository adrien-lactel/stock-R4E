# Stock R4E - AI Coding Assistant Instructions

## Project Overview
**Stock R4E** is a Laravel 12 inventory & repair management system for gaming consoles and electronics. It tracks stock across multiple stores, handles repair workflows, and manages pricing. The architecture uses Eloquent ORM with complex pivot relationships for multi-store console distribution.

## Core Architecture

### Domain Model (Key Relationships)
- **Console** (central entity): Gaming consoles with status tracking (`stock`, `vendue`, `defective`)
  - `belongsToMany(Store)` via `console_store_prices` pivot (includes `sale_price`)
  - `hasMany(ConsoleReturn)` for return requests
  - `hasMany(RepairQuote)` for repair estimates
  - `hasMany(Mod)` for hardware modifications
  - `belongsTo(ArticleCategory/SubCategory/Type)` for taxonomy
  - `belongsTo(Repairer)` for repair assignment
  
- **Store**: Physical retail locations, each with one `User` account
  - `belongsToMany(Console)` via pivot with pricing
  - `hasMany(ConsoleStorePrice)` for explicit pricing control
  - `hasMany(Invoice, Article)`

- **ArticleCategory → ArticleSubCategory → ArticleType**: Taxonomy hierarchy for product classification (separate from old `ConsoleType`)

### Key Patterns
1. **Scopes for Status Queries**: Use `Console::stock()`, `::defective()`, `::sold()` instead of manual `where` clauses
2. **Pivot Relationships**: `console_store_prices` table stores console-store link WITH price data; always eager-load with `->withPivot('sale_price')`
3. **Soft Deletes**: `Repairer` uses `SoftDeletes` trait; check migrations for others
4. **Factory Behavior**: `ConsoleFactory` auto-creates `Invoice` after creation if status is `vendue`

## Development Workflow

### Commands
```bash
npm run dev          # Start Vite + Laravel server + queue + logs
npm run build        # Production build
php artisan tinker   # Interactive REPL for Console model exploration
php artisan test     # Run Pest tests (Unit + Feature suites)
php artisan migrate  # Apply pending migrations
```

### Testing Setup
- **Framework**: Pest 4.2 (uses `expect()` API, not assertions)
- **Database**: SQLite in-memory for tests (see `phpunit.xml`)
- **Fixtures**: Auto-refreshes database via `RefreshDatabase` trait in `Feature` tests
- **Factories**: All models have factories in `database/factories/`; use `Model::factory()->create()` in tests

## Project-Specific Conventions

### 1. Controller Organization
- **Admin Controllers**: `app/Http/Controllers/Admin/` - Handle system-wide management
- **Store Controllers**: `app/Http/Controllers/Store/` - Store-specific dashboards
- Pattern: Use dependency injection, validate with `Request::validate()`, return view with compact()

### 2. Model Fillable Arrays
- **Console**: Contains 40+ fields including legacy fields (`prix_achat`, `lieu_stockage`) + new taxonomy fields (`article_category_id`, etc.)
- Always check `protected $fillable` before mass-assigning; use `Model::only()` if needed
- Common nested fillables across models; extract shared patterns to base Model class if adding new domain concepts

### 3. AJAX Routes & Taxonomy
- **Route**: `/admin/ajax/sub-categories/{category}` (see `TaxonomyController::ajaxSubCategories`)
- **Pattern**: Used for cascading dropdowns (Category → SubCategory → Type)
- **When modifying taxonomy**: Update both Model relationships AND AJAX endpoints

### 4. Migration Sequencing
- Migrations are date-prefixed and executed in order
- Recent migrations show pattern evolution: legacy `console_type_id` was dropped, replaced by three-level taxonomy
- Check `2026_01_04_142403_add_article_relations_to_consoles_table.php` for the taxonomy addition pattern
- Always include `$table->dropIfExists()` in `down()` for migrations adding relations

### 5. Database Pivot Tables
- **`console_store_prices`**: Links Console ↔ Store with sale price; use `updateOrCreate()` for upserts
- Never create inline pivot records; always use explicit table management
- See `ConsolePriceController::storePrice()` for the standard update pattern

## Integration Points

### API/AJAX
- **Sub-category selection**: `/admin/ajax/sub-categories/{categoryId}` returns HTML options
- **Modify ONLY through**: `TaxonomyController` methods; ensure both data layer and AJAX endpoints stay in sync

### External Dependencies
- **Tailwind CSS 4 + Vite**: Assets in `resources/css/js`, compiled to `public/build/`
- **Alpine.js 3.4**: For lightweight interactivity (check views for `x-` directives)
- **Laravel Breeze**: Scaffolded auth UI; modify only `auth.php` routes if changing auth structure

## Common Workflows

### Adding a New Console Field
1. Create migration: `php artisan make:migration add_field_to_consoles_table`
2. Add to `Console::$fillable`
3. Update factory if it's a critical field
4. Update relevant controllers/views

### Creating a Repair Workflow Feature
1. Extend `RepairQuote` model with new relationship
2. Add controller method in `RepairerAdminController` or `ConsoleReturnController`
3. Add route in `routes/web.php` under `admin` prefix
4. Test with Pest (create feature test in `tests/Feature/`)

### Multi-Store Console Pricing
1. Load console with `->with('stores')` or `->with('consolePrices')`
2. Access pivot: `$console->stores()->first()->pivot->sale_price`
3. Upsert via `ConsoleStorePrice::updateOrCreate([...], [...])`
4. Never directly update `Console` `price` field for store-specific pricing

## Files to Know
- **Models**: [app/Models](../app/Models) - 15 entities including new Repairer
- **Controllers**: [app/Http/Controllers/Admin](../app/Http/Controllers/Admin) - Core business logic
- **Migrations**: [database/migrations](../database/migrations) - Schema evolution (read 2026_01_04_* for taxonomy pattern)
- **Factories**: [database/factories](../database/factories) - Use for seeding/testing
- **Routes**: [routes/web.php](../routes/web.php) - All routes use auth middleware + prefix namespacing
