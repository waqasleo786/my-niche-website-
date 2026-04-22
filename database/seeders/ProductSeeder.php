<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catId = fn (string $slug): int => (int) Category::where('slug', $slug)->value('id');

        $products = [
            // Keychains
            [
                'name'             => 'Premium Metal Keychain',
                'category_slug'    => 'keychains',
                'sku'              => 'KC-001',
                'price'            => 450.00,
                'b2b_price'        => 320.00,
                'min_b2b_quantity' => 100,
                'stock_quantity'   => 500,
                'is_featured'      => true,
                'description'      => 'High-quality zinc alloy metal keychain. Available with custom logo engraving. Perfect for corporate gifts and promotions.',
            ],
            [
                'name'             => 'Zinc Alloy Logo Keychain',
                'category_slug'    => 'keychains',
                'sku'              => 'KC-002',
                'price'            => 380.00,
                'b2b_price'        => 270.00,
                'min_b2b_quantity' => 100,
                'stock_quantity'   => 300,
                'is_featured'      => false,
                'description'      => 'Durable zinc alloy keychain with logo printing area. Ideal for brand promotions.',
            ],
            [
                'name'             => 'Leather Keychain with Clip',
                'category_slug'    => 'keychains',
                'sku'              => 'KC-003',
                'price'            => 520.00,
                'b2b_price'        => 390.00,
                'min_b2b_quantity' => 50,
                'stock_quantity'   => 200,
                'is_featured'      => false,
                'description'      => 'Premium leather keychain with metal clip. A sophisticated corporate gift item.',
            ],
            // Pens
            [
                'name'             => 'Executive Ballpoint Pen',
                'category_slug'    => 'pens',
                'sku'              => 'PN-001',
                'price'            => 180.00,
                'b2b_price'        => 120.00,
                'min_b2b_quantity' => 200,
                'stock_quantity'   => 1000,
                'is_featured'      => true,
                'description'      => 'Smooth writing metal ballpoint pen with twist mechanism. Custom logo engraving available on barrel.',
            ],
            [
                'name'             => 'Metal Roller Pen',
                'category_slug'    => 'pens',
                'sku'              => 'PN-002',
                'price'            => 320.00,
                'b2b_price'        => 230.00,
                'min_b2b_quantity' => 100,
                'stock_quantity'   => 500,
                'is_featured'      => false,
                'description'      => 'Elegant metal roller pen with smooth ink flow. Available with engraved branding.',
            ],
            [
                'name'             => 'Soft Touch Matte Pen',
                'category_slug'    => 'pens',
                'sku'              => 'PN-003',
                'price'            => 220.00,
                'b2b_price'        => 155.00,
                'min_b2b_quantity' => 200,
                'stock_quantity'   => 800,
                'is_featured'      => false,
                'description'      => 'Soft-touch rubberized finish pen with comfortable grip. Great for trade shows.',
            ],
            // Power Banks
            [
                'name'             => '10000mAh Power Bank',
                'category_slug'    => 'power-banks',
                'sku'              => 'PB-001',
                'price'            => 1800.00,
                'b2b_price'        => 1400.00,
                'min_b2b_quantity' => 50,
                'stock_quantity'   => 150,
                'is_featured'      => true,
                'description'      => '10000mAh slim power bank with dual USB output. Custom logo printing on the casing.',
            ],
            [
                'name'             => 'Slim USB-C Power Bank 5000mAh',
                'category_slug'    => 'power-banks',
                'sku'              => 'PB-002',
                'price'            => 2200.00,
                'b2b_price'        => 1750.00,
                'min_b2b_quantity' => 50,
                'stock_quantity'   => 100,
                'is_featured'      => true,
                'description'      => 'Ultra-slim USB-C power bank with 5000mAh capacity. Fits in any pocket.',
            ],
            [
                'name'             => 'Wireless Charging Power Bank',
                'category_slug'    => 'power-banks',
                'sku'              => 'PB-003',
                'price'            => 3500.00,
                'b2b_price'        => 2800.00,
                'min_b2b_quantity' => 25,
                'stock_quantity'   => 75,
                'is_featured'      => false,
                'description'      => '10000mAh wireless charging power bank with Qi compatibility. Premium corporate gift.',
            ],
            // USB Drives
            [
                'name'             => '32GB Metal USB Drive',
                'category_slug'    => 'usb-drives',
                'sku'              => 'USB-001',
                'price'            => 950.00,
                'b2b_price'        => 720.00,
                'min_b2b_quantity' => 100,
                'stock_quantity'   => 300,
                'is_featured'      => true,
                'description'      => '32GB metal USB 3.0 drive with keychain loop. Custom logo laser engraving available.',
            ],
            [
                'name'             => '64GB Card-Style USB Drive',
                'category_slug'    => 'usb-drives',
                'sku'              => 'USB-002',
                'price'            => 1200.00,
                'b2b_price'        => 950.00,
                'min_b2b_quantity' => 100,
                'stock_quantity'   => 200,
                'is_featured'      => false,
                'description'      => 'Credit card sized USB drive with 64GB storage. Slim design for easy carrying.',
            ],
            // Bottles & Tumblers
            [
                'name'             => 'Stainless Steel Tumbler',
                'category_slug'    => 'bottles-tumblers',
                'sku'              => 'BT-001',
                'price'            => 1200.00,
                'b2b_price'        => 950.00,
                'min_b2b_quantity' => 50,
                'stock_quantity'   => 200,
                'is_featured'      => true,
                'description'      => '500ml double-wall stainless steel tumbler. Keeps drinks hot for 8 hours, cold for 12 hours.',
            ],
            [
                'name'             => 'Insulated Water Bottle 700ml',
                'category_slug'    => 'bottles-tumblers',
                'sku'              => 'BT-002',
                'price'            => 850.00,
                'b2b_price'        => 650.00,
                'min_b2b_quantity' => 100,
                'stock_quantity'   => 150,
                'is_featured'      => false,
                'description'      => '700ml vacuum insulated water bottle with leak-proof lid. Custom logo printing available.',
            ],
            // Clocks
            [
                'name'             => 'Digital Desk Clock',
                'category_slug'    => 'clocks',
                'sku'              => 'CL-001',
                'price'            => 1500.00,
                'b2b_price'        => 1200.00,
                'min_b2b_quantity' => 25,
                'stock_quantity'   => 100,
                'is_featured'      => true,
                'description'      => 'Compact digital desk clock with date and temperature display. Custom logo on clock face.',
            ],
            [
                'name'             => 'Wall Clock with Logo Print',
                'category_slug'    => 'clocks',
                'sku'              => 'CL-002',
                'price'            => 1800.00,
                'b2b_price'        => 1450.00,
                'min_b2b_quantity' => 25,
                'stock_quantity'   => 80,
                'is_featured'      => false,
                'description'      => '30cm wall clock with large logo printing area. Perfect for office branding.',
            ],
        ];

        foreach ($products as $data) {
            Product::create([
                'category_id'      => $catId($data['category_slug']),
                'name'             => $data['name'],
                'description'      => $data['description'],
                'sku'              => $data['sku'],
                'price'            => $data['price'],
                'b2b_price'        => $data['b2b_price'],
                'min_b2b_quantity' => $data['min_b2b_quantity'],
                'stock_quantity'   => $data['stock_quantity'],
                'is_active'        => true,
                'is_featured'      => $data['is_featured'],
            ]);
        }
    }
}
