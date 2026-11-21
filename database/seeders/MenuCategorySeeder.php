<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuCategorySeeder extends Seeder
{
    /**
     * Seed the official RDC BEAR menu categories.
     *
     * TODO: Replace with official menu data before production.
     */
    public function run(): void
    {
        // 1. Remove 12 initial dummy items if they exist
        $dummyNames = [
            'The Bear Reserve Espresso',
            'Kyoto Iced Matcha',
            'Oat Flat White',
            'Americano',
            'Pour Over',
            'Cappuccino',
            'Affogato',
            'Cold Brew',
            'Mocha',
            'Twice-Baked Almond Croissant',
            'Breton Kouign-Amann',
            'Valrhona Chocolate Sea Salt Cookie'
        ];

        Menu::whereIn('name', $dummyNames)->delete();

        // Remove old dummy categories if they have no remaining menus
        $oldCategoryNames = ['Curated Offerings', 'The Classics', 'Fresh Pastries', 'Specialty Coffee', 'Signature Mocktails', 'Cyber Delicacies', 'Glowing Desserts'];
        foreach ($oldCategoryNames as $catName) {
            $cat = MenuCategory::where('name', $catName)->first();
            if ($cat && $cat->menus()->count() === 0) {
                $cat->delete();
            }
        }

        // 2. Idempotent seeding for the 6 official cafe categories
        // TODO: Replace with official menu data before production.
        $categories = [
            ['name' => 'Rice Bowl', 'sort_order' => 1],
            ['name' => 'Burger', 'sort_order' => 2],
            ['name' => 'Pasta & Pizza', 'sort_order' => 3],
            ['name' => 'Grill & Sate', 'sort_order' => 4],
            ['name' => 'Drinks', 'sort_order' => 5],
            ['name' => 'Dessert', 'sort_order' => 6],
        ];

        foreach ($categories as $cat) {
            MenuCategory::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'sort_order' => $cat['sort_order'],
                ]
            );
        }
    }
}
