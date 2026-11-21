<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MenuCategory;
use App\Models\Menu;
use App\Models\Gallery;
use App\Models\Facility;
use App\Models\Testimonial;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin Staff User
        User::updateOrCreate(
            ['email' => 'admin@rdcbear.com'],
            [
                'name' => 'RDC BEAR Admin Staff',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Seed Contact & Location Settings Info (Unified address across system)
        Contact::updateOrCreate(
            ['id' => 1],
            [
                'whatsapp' => '1234567890',
                'phone' => '+1 (234) 567-890',
                'email' => 'hello@rdcbear.com',
                'address' => '128 Minimalist Ave, Design District, City Center 10012',
                'business_hours' => 'Mon - Fri: 7:00 AM - 6:00 PM | Sat - Sun: 8:00 AM - 7:00 PM',
                'google_maps_link' => 'https://maps.google.com/maps?q=-6.2238125,106.819778&z=15&output=embed',
            ]
        );

        // 3. Seed Menu Categories
        $catCurated = MenuCategory::firstOrCreate(['name' => 'Curated Offerings'], ['slug' => 'curated-offerings']);
        $catClassics = MenuCategory::firstOrCreate(['name' => 'The Classics'], ['slug' => 'the-classics']);
        $catPastries = MenuCategory::firstOrCreate(['name' => 'Fresh Pastries'], ['slug' => 'fresh-pastries']);

        // 4. Seed RDC BEAR Menu Items with Real High-Res Photos
        // Curated Offerings
        Menu::updateOrCreate(
            ['name' => 'The Bear Reserve Espresso'],
            [
                'menu_category_id' => $catCurated->id,
                'slug' => Str::slug('The Bear Reserve Espresso'),
                'description' => 'A complex, single-origin Ethiopian roast with notes of wild honey, bergamot, and a dark cocoa finish. Pulled ristretto.',
                'price' => 6.50,
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ]
        );

        Menu::updateOrCreate(
            ['name' => 'Kyoto Iced Matcha'],
            [
                'menu_category_id' => $catCurated->id,
                'slug' => Str::slug('Kyoto Iced Matcha'),
                'description' => 'Ceremonial grade matcha, lightly sweetened, oat milk.',
                'price' => 5.50,
                'image' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ]
        );

        Menu::updateOrCreate(
            ['name' => 'Oat Flat White'],
            [
                'menu_category_id' => $catCurated->id,
                'slug' => Str::slug('Oat Flat White'),
                'description' => 'Double ristretto, micro-foamed oat milk.',
                'price' => 5.00,
                'image' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ]
        );

        // The Classics
        $classics = [
            ['name' => 'Americano', 'price' => 3.50, 'desc' => 'Hot water poured over a double shot of our house blend.'],
            ['name' => 'Pour Over', 'price' => 5.00, 'desc' => 'Rotating selection of single-origin beans, brewed manually.'],
            ['name' => 'Cappuccino', 'price' => 4.50, 'desc' => 'Equal parts espresso, steamed milk, and dense micro-foam.'],
            ['name' => 'Affogato', 'price' => 6.00, 'desc' => 'A scoop of vanilla bean gelato drowned in a hot espresso shot.'],
            ['name' => 'Cold Brew', 'price' => 4.50, 'desc' => 'Steeped for 24 hours for a smooth, low-acidity profile.'],
            ['name' => 'Mocha', 'price' => 5.50, 'desc' => 'Espresso layered with artisanal dark chocolate and steamed milk.'],
        ];

        foreach ($classics as $c) {
            Menu::updateOrCreate(
                ['name' => $c['name']],
                [
                    'menu_category_id' => $catClassics->id,
                    'slug' => Str::slug($c['name']),
                    'description' => $c['desc'],
                    'price' => $c['price'],
                    'image' => null,
                    'is_featured' => false,
                ]
            );
        }

        // Fresh Pastries
        $pastries = [
            [
                'name' => 'Twice-Baked Almond Croissant',
                'price' => 4.50,
                'desc' => 'Filled with rich frangipane cream.',
                'image' => 'https://images.unsplash.com/photo-1623334044303-241021148842?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Breton Kouign-Amann',
                'price' => 5.00,
                'desc' => 'Caramelized layers of buttery dough.',
                'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Valrhona Chocolate Sea Salt Cookie',
                'price' => 3.50,
                'desc' => 'Dark chocolate chunks, Maldon sea salt flakes.',
                'image' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?auto=format&fit=crop&w=800&q=80'
            ],
        ];

        foreach ($pastries as $p) {
            Menu::updateOrCreate(
                ['name' => $p['name']],
                [
                    'menu_category_id' => $catPastries->id,
                    'slug' => Str::slug($p['name']),
                    'description' => $p['desc'],
                    'price' => $p['price'],
                    'image' => $p['image'],
                    'is_featured' => false,
                ]
            );
        }

        // 5. Seed Testimonials for Carousel
        Testimonial::updateOrCreate(
            ['name' => 'Elena Rostova'],
            [
                'role' => 'Head Roaster, RDC BEAR',
                'review' => 'We don\'t just serve coffee; we curate an experience. Every cup is a culmination of a long journey, from a distant hillside to your hands, crafted with intention and respect.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80',
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Marcus Chen'],
            [
                'role' => 'Architectural Designer',
                'review' => 'The minimalist Scandinavian design combined with their Kyoto Iced Matcha makes RDC BEAR my daily focus space. Quiet, warm, and exceptionally crafted.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80',
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Sophia Thorne'],
            [
                'role' => 'Coffee Connoisseur',
                'review' => 'The Bear Reserve Espresso has an unmatched depth. Perfect acidity, velvety crema, and a subtle dark cocoa finish that lingers beautifully.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80',
            ]
        );

        // 6. Seed Gallery
        $galleries = [
            ['caption' => 'Spacious Interior Lounge', 'image' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=1200&q=80', 'category' => 'Interior'],
            ['caption' => 'Precision Pour Over', 'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=80', 'category' => 'Craft'],
            ['caption' => 'Minimalist Seating Corner', 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80', 'category' => 'Design'],
            ['caption' => 'Artisanal Espresso Machine', 'image' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=1200&q=80', 'category' => 'Equipment'],
        ];

        foreach ($galleries as $g) {
            Gallery::updateOrCreate(
                ['caption' => $g['caption']],
                [
                    'image' => $g['image'],
                    'category' => $g['category'],
                ]
            );
        }
    }
}
