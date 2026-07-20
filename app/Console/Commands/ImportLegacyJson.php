<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportLegacyJson extends Command
{
    protected $signature = 'import:legacy
        {categories : Path to categories.json}
        {products : Path to products.json}
        {--images= : Path to the old uploads/ folder, to copy images across}';

    protected $description = 'One-time import of categories.json/products.json (from the earlier plain-PHP admin) into the database';

    public function handle(): int
    {
        $categoriesPath = $this->argument('categories');
        $productsPath = $this->argument('products');
        $imagesPath = $this->option('images');

        if (! file_exists($categoriesPath)) {
            $this->error("Categories file not found: {$categoriesPath}");
            return self::FAILURE;
        }
        if (! file_exists($productsPath)) {
            $this->error("Products file not found: {$productsPath}");
            return self::FAILURE;
        }

        $categoriesData = json_decode(file_get_contents($categoriesPath), true) ?: [];
        $productsData = json_decode(file_get_contents($productsPath), true) ?: [];

        $categoryIdMap = [];

        $this->info('Importing categories...');
        foreach ($categoriesData as $row) {
            $image = $this->copyImage($row['image'] ?? null, 'categories', $imagesPath);

            $category = Category::updateOrCreate(
                ['name_en' => $row['name_en']],
                [
                    'name_ta' => $row['name_ta'] ?? null,
                    'image' => $image,
                ]
            );

            $categoryIdMap[$row['id']] = $category->id;
            $this->line(" - {$category->name_en}");
        }

        $this->info('Importing products...');
        foreach ($productsData as $row) {
            $oldCategoryId = $row['category_id'] ?? null;
            if (! isset($categoryIdMap[$oldCategoryId])) {
                $this->warn(" - Skipping \"{$row['name_en']}\" — its category wasn't found.");
                continue;
            }

            $image = $this->copyImage($row['image'] ?? null, 'products', $imagesPath);

            $product = Product::updateOrCreate(
                ['name_en' => $row['name_en'], 'category_id' => $categoryIdMap[$oldCategoryId]],
                [
                    'name_ta' => $row['name_ta'] ?? null,
                    'description' => $row['description'] ?? null,
                    'additional_details' => $row['additional_details'] ?? null,
                    'sort_order' => $row['sort_order'] ?? 0,
                    'image' => $image,
                ]
            );

            // Supports both the new multi-pack "variants" array and the
            // older single quantity_value/quantity_unit/price shape.
            $variants = $row['variants'] ?? [];
            if (empty($variants) && isset($row['quantity_value'])) {
                $variants = [[
                    'value' => $row['quantity_value'],
                    'unit' => $row['quantity_unit'] ?? 'gms',
                    'price' => $row['price'] ?? 0,
                ]];
            }

            $product->variants()->delete();
            foreach ($variants as $v) {
                $product->variants()->create([
                    'value' => $v['value'],
                    'unit' => $v['unit'] ?? 'gms',
                    'price' => $v['price'],
                ]);
            }

            $this->line(" - {$product->name_en} ({$product->variants()->count()} pack size(s))");
        }

        $this->info('Done.');
        return self::SUCCESS;
    }

    /**
     * Copies an image referenced by the old JSON data (e.g. "/uploads/products/xyz.jpg")
     * into the new "public" storage disk, and returns its new relative path.
     * Returns null if there's no image or the --images source folder wasn't given.
     */
    private function copyImage(?string $oldPath, string $subfolder, ?string $imagesRoot): ?string
    {
        if (! $oldPath || ! $imagesRoot) {
            return null;
        }

        $relative = ltrim($oldPath, '/');
        $relative = preg_replace('#^uploads/#', '', $relative);
        $sourceFile = rtrim($imagesRoot, '/\\').DIRECTORY_SEPARATOR.$relative;

        if (! file_exists($sourceFile)) {
            return null;
        }

        $filename = basename($sourceFile);
        $newRelativePath = $subfolder.'/'.$filename;
        Storage::disk('public')->put($newRelativePath, file_get_contents($sourceFile));

        return $newRelativePath;
    }
}