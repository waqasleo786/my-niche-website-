<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@shahidbrothers.pk'],
            [
                'name'              => 'Admin',
                'email'             => 'admin@shahidbrothers.pk',
                'password'          => Hash::make('Admin@1234'),
                'email_verified_at' => now(),
                'is_b2b'            => false,
                'is_verified'       => true,
            ]
        );

        $admin->assignRole('admin');

        $this->command->info('✅ Admin user created/updated.');
        $this->command->table(
            ['Field', 'Value'],
            [
                ['Email',    'admin@shahidbrothers.pk'],
                ['Password', 'Admin@1234'],
                ['Role',     'admin'],
            ]
        );
    }
}
