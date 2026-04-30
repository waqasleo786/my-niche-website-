<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // -------------------------------------------------------------------
        // Permissions
        // -------------------------------------------------------------------
        $permissions = [
            // Products
            'view products',
            'manage products',

            // Orders
            'view own orders',
            'view all orders',
            'manage orders',

            // Users
            'manage users',
            'approve b2b',

            // Categories
            'manage categories',

            // Gift Box Builder (per-user access, granted manually by admin)
            'view_gift_builder',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // -------------------------------------------------------------------
        // Roles
        // -------------------------------------------------------------------

        // Admin — full access
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        // B2B Customer — can view B2B prices, place bulk orders
        $b2b = Role::firstOrCreate(['name' => 'b2b_customer']);
        $b2b->syncPermissions([
            'view products',
            'view own orders',
        ]);

        // Regular Customer
        $customer = Role::firstOrCreate(['name' => 'customer']);
        $customer->syncPermissions([
            'view products',
            'view own orders',
        ]);

        $this->command->info('✅ Roles and permissions seeded successfully.');
        $this->command->table(
            ['Role', 'Permissions'],
            [
                ['admin', 'All permissions'],
                ['b2b_customer', 'view products, view own orders'],
                ['customer', 'view products, view own orders'],
            ]
        );
    }
}
