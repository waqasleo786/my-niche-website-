<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Keychains',
                'description' => 'Metal, leather and novelty keychains for corporate gifting.',
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Pens',
                'description' => 'Ballpoint, roller and gel pens with custom logo printing.',
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Power Banks',
                'description' => 'Portable power banks from 5000mAh to 20000mAh.',
                'sort_order'  => 3,
            ],
            [
                'name'        => 'USB Drives',
                'description' => 'Flash drives in metal, card and novelty designs.',
                'sort_order'  => 4,
            ],
            [
                'name'        => 'Bottles & Tumblers',
                'description' => 'Stainless steel bottles and vacuum insulated tumblers.',
                'sort_order'  => 5,
            ],
            [
                'name'        => 'Clocks',
                'description' => 'Desk and wall clocks with custom branding options.',
                'sort_order'  => 6,
            ],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(
                ['name' => $data['name']],
                [
                    'description' => $data['description'],
                    'is_active'   => true,
                    'sort_order'  => $data['sort_order'],
                ]
            );
        }
    }
}
