# Filament 3 Admin Setup - Complete Implementation Guide

## Overview
This document describes the completed setup for a Filament 3 admin panel with **Products** and **Collections** management system, featuring:
- ✅ Multi-language support (English & Indonesian) via Spatie Translatable
- ✅ Automatic slug generation via Spatie Sluggable  
- ✅ Media management (thumbnails & galleries) via Spatie MediaLibrary
- ✅ Complex relationships (Many-to-Many, Self-referencing)
- ✅ Rich text editor for product/collection content
- ✅ Featured product toggling
- ✅ Database seeders with realistic data

---

## 📦 Installation Steps

### 1. Install Composer Dependencies
```bash
composer update
```

This will install:
- `filament/filament` (^3.2) - Admin panel framework
- `spatie/laravel-translatable` (^6.3) - Multi-language support
- `spatie/laravel-sluggable` (^3.5) - Auto slug generation
- `spatie/laravel-medialibrary` (^11.4) - File & image management
- `filament/spatie-laravel-translatable-plugin` (^3.2) - Filament integration for translations
- `filament/spatie-laravel-media-library-plugin` (^3.2) - Filament integration for media

### 2. Publish Spatie MediaLibrary Migrations & Assets
```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
```

### 3. Install Filament Admin Panel
```bash
php artisan filament:install --panels
```

This creates:
- `app/Filament/AdminPanelProvider.php` - Panel configuration
- `app/Filament/Pages/Dashboard.php` - Dashboard page

### 4. Update AdminPanelProvider Configuration
Edit `app/Filament/AdminPanelProvider.php`:

```php
use Filament\Support\Enums\Platform;
use Spatie\LaravelFilamentTranslatablePlugin\FilamentTranslatablePlugin;
use Spatie\LaravelFilamentMediaLibraryPlugin\FilamentMediaLibraryPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        ->resources([
            // Resources are auto-registered
        ])
        ->plugins([
            FilamentTranslatablePlugin::make()
                ->defaultLocales(['en', 'id']),
            FilamentMediaLibraryPlugin::make(),
        ])
        ->databaseNotifications();
}
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate
php artisan db:seed
```

This creates:
- `collections` table with translatable fields
- `products` table with translatable fields  
- `collection_product` pivot table (Many-to-Many)
- `product_related` pivot table (Related Products)
- `media` table (from Spatie MediaLibrary)
- 10 sample collections
- 50 sample products with relationships

### 6. Create Symbolic Link for Media
```bash
php artisan storage:link
```

---

## 📁 File Structure

```
app/
  ├── Models/
  │   ├── Collection.php       (Translatable, Sluggable, with Media)
  │   ├── Product.php          (Translatable, Sluggable, with Media)
  │   └── User.php
  └── Filament/
      └── Resources/
          ├── CollectionResource.php
          │   └── Pages/
          │       ├── ListCollections.php
          │       ├── CreateCollection.php
          │       └── EditCollection.php
          └── ProductResource.php
              └── Pages/
                  ├── ListProducts.php
                  ├── CreateProduct.php
                  └── EditProduct.php

database/
  ├── migrations/
  │   ├── 2026_07_20_000000_create_collections_table.php
  │   ├── 2026_07_20_000001_create_products_table.php
  │   ├── 2026_07_20_000002_create_collection_product_table.php
  │   └── 2026_07_20_000003_create_product_related_table.php
  ├── factories/
  │   ├── CollectionFactory.php
  │   └── ProductFactory.php
  └── seeders/
      ├── CollectionSeeder.php
      ├── ProductSeeder.php
      └── DatabaseSeeder.php (updated)
```

---

## 🗂️ Models Overview

### Collection Model
**File**: `app/Models/Collection.php`

**Traits**:
- `HasTranslations` - Multi-language support
- `HasSlug` - Auto slug generation
- `InteractsWithMedia` - File management

**Translatable Fields** (EN, ID):
- `name` - Collection name
- `slug` - URL-friendly name (auto-generated)
- `short_description` - Brief description
- `body_content` - Rich text content

**Non-translatable Fields**:
- `body_content_pos` - Position of content (left/right)

**Media Collections**:
- `thumbnail` - Single image (singleFile)
- `hero_background` - Single large image (singleFile)

**Relationships**:
- `products()` - BelongsToMany Product (Many-to-Many)

---

### Product Model
**File**: `app/Models/Product.php`

**Traits**:
- `HasTranslations` - Multi-language support
- `HasSlug` - Auto slug generation  
- `InteractsWithMedia` - File management

**Translatable Fields** (EN, ID):
- `name` - Product name
- `slug` - URL-friendly name (auto-generated)
- `short_description` - Brief description
- `body_content` - Rich text content

**Non-translatable Fields**:
- `attributes` - Additional information (Simple text field)
- `is_best_seller` - Boolean flag for featured products

**Media Collections**:
- `thumbnail` - Single product image (singleFile)
- `collection_images` - Multiple gallery images

**Relationships**:
- `collections()` - BelongsToMany Collection (Many-to-Many)
- `relatedProducts()` - BelongsToMany Product (Self-referencing)
- `relatedAsProducts()` - Inverse of relatedProducts

---

## 🎨 Filament Resources

### CollectionResource
**File**: `app/Filament/Resources/CollectionResource.php`

**Features**:
- Tabbed form for language switching (EN/ID)
- TextInput for Name & Slug
- Textarea for Short Description
- RichEditor for Body Content
- Select dropdown for position (Left/Right)
- Media upload for Thumbnail & Hero Background
- Table view with search, sort, and filters
- Action buttons for Edit/Delete
- Bulk delete action

### ProductResource  
**File**: `app/Filament/Resources/ProductResource.php`

**Features**:
- Tabbed form for language switching (EN/ID)
- TextInput for Name & Slug
- Textarea for Short Description
- RichEditor for Body Content
- Textarea for Attributes
- Toggle for Featured Product flag
- Multi-select for Collections (relationship)
- Multi-select for Related Products (relationship)
- Media upload for Thumbnail & Gallery Images
- Table view with thumbnail preview, search, sort
- Filter by featured products
- Action buttons for Edit/Delete
- Bulk delete action

---

## 💾 Database Schema

### collections table
```sql
CREATE TABLE collections (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name JSON NOT NULL,              -- {"en": "...", "id": "..."}
    slug JSON NOT NULL,              -- {"en": "...", "id": "..."}
    short_description JSON,          -- {"en": "...", "id": "..."}
    body_content JSON,               -- {"en": "...", "id": "..."}
    body_content_pos VARCHAR(255) DEFAULT 'left',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### products table
```sql
CREATE TABLE products (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name JSON NOT NULL,              -- {"en": "...", "id": "..."}
    slug JSON NOT NULL,              -- {"en": "...", "id": "..."}
    short_description JSON,          -- {"en": "...", "id": "..."}
    body_content JSON,               -- {"en": "...", "id": "..."}
    attributes TEXT,
    is_best_seller BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### collection_product table
```sql
CREATE TABLE collection_product (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    collection_id BIGINT FOREIGN KEY,
    product_id BIGINT FOREIGN KEY,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(collection_id, product_id)
);
```

### product_related table
```sql
CREATE TABLE product_related (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT FOREIGN KEY,
    related_id BIGINT FOREIGN KEY,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(product_id, related_id)
);
```

### media table
(Created by Spatie MediaLibrary)
```sql
CREATE TABLE media (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    model_id BIGINT FOREIGN KEY,
    model_type VARCHAR(255),
    collection_name VARCHAR(255),
    name VARCHAR(255),
    file_name VARCHAR(255),
    mime_type VARCHAR(255),
    disk VARCHAR(255),
    size BIGINT,
    conversions JSON,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    INDEX(model_type, model_id, collection_name)
);
```

---

## 🌐 Access the Admin Panel

After completing all steps:

1. Start the Laravel development server:
```bash
php artisan serve
```

2. Visit the admin panel:
```
http://localhost:8000/admin
```

3. You'll see the Filament dashboard with two menu items:
   - **Collections** - Manage product collections
   - **Products** - Manage products

---

## 🎯 Usage Examples

### Creating a Collection
1. Go to Collections → Create
2. Fill in English name & slug
3. Switch to Indonesian tab, fill in Indonesian name & slug
4. Add thumbnail & hero background images
5. Select position (Left or Right)
6. Click Create

### Creating a Product
1. Go to Products → Create
2. Fill in multilingual fields (English & Indonesian)
3. Add attributes/specifications
4. Toggle "Featured Product" if desired
5. Select collections from dropdown
6. Select related products from dropdown
7. Upload thumbnail & gallery images
8. Click Create

### Editing Relationships
- Collections show a count of products on the list table
- Products can be edited to change their collections or related products
- Many-to-Many relationships are managed with multi-select dropdowns

---

## 🔍 Querying Data in Code

### Get a collection with all products
```php
$collection = Collection::with('products')->find(1);
foreach ($collection->products as $product) {
    echo $product->name['en']; // "Product Name" in English
}
```

### Get product name in specific locale
```php
$product = Product::find(1);
$product->setLocale('id');
echo $product->name; // Output in Indonesian
```

### Get product thumbnail
```php
$product = Product::find(1);
$url = $product->getFirstMediaUrl('thumbnail');
```

### Get all product gallery images
```php
$product = Product::find(1);
$images = $product->getMedia('collection_images');
foreach ($images as $image) {
    echo $image->getUrl();
}
```

### Get featured products
```php
$featured = Product::where('is_best_seller', true)->get();
```

### Get related products
```php
$product = Product::find(1);
$relatedProducts = $product->relatedProducts;
```

---

## ⚙️ Configuration Notes

### Locales
The system supports **English (en)** and **Indonesian (id)** by default. To add more locales:

1. Update `app/Filament/AdminPanelProvider.php`:
```php
FilamentTranslatablePlugin::make()
    ->defaultLocales(['en', 'id', 'fr']),
```

2. Update seeder data in `database/factories/*.php`

### Media Storage
- Images are stored in `storage/app/public`
- Access via `/storage/` routes (after `php artisan storage:link`)
- Configure disk in `config/media-library.php`

### Slug Generation
- Slugs are automatically generated from the `name` field
- You can override manually if needed
- Separate slugs for each language

---

## 🐛 Troubleshooting

**Q: Translatable fields not showing tabs?**
A: Ensure `FilamentTranslatablePlugin::make()` is registered in AdminPanelProvider

**Q: Media upload not working?**
A: Run `php artisan storage:link` and check `config/filesystems.php`

**Q: Slugs not auto-generating?**
A: Check model has `HasSlug` trait and `getSlugOptions()` method defined

**Q: Relationships not loading?**
A: Verify pivot table names match model definition (collection_product, product_related)

---

## 📚 Resources

- [Filament Documentation](https://filamentphp.com)
- [Spatie Translatable](https://github.com/spatie/laravel-translatable)
- [Spatie Sluggable](https://github.com/spatie/laravel-sluggable)
- [Spatie MediaLibrary](https://spatie.be/docs/laravel-medialibrary/v11/introduction)

---

## ✅ Verification Checklist

- [ ] Composer packages installed (`composer update`)
- [ ] Spatie MediaLibrary migrations published & migrated
- [ ] Filament panel installed (`php artisan filament:install`)
- [ ] AdminPanelProvider configured with plugins
- [ ] Database migrations run (`php artisan migrate`)
- [ ] Seeders executed (`php artisan db:seed`)
- [ ] Storage link created (`php artisan storage:link`)
- [ ] Admin panel accessible at `/admin`
- [ ] Collections resource visible & functional
- [ ] Products resource visible & functional
- [ ] Media uploads working for both resources
- [ ] Translatable fields switching between EN/ID
- [ ] Sample data visible in tables (10 collections, 50 products)

---

**Implementation Date**: July 20, 2026  
**Framework**: Laravel 12 + Filament 3 + Spatie Packages
