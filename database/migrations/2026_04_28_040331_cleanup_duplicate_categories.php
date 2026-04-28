<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $names = ['Keychains', 'Pens', 'Power Banks', 'USB Drives', 'Bottles & Tumblers', 'Clocks'];

        foreach ($names as $name) {
            $ids = DB::table('categories')
                ->where('name', $name)
                ->orderBy('id')
                ->pluck('id');

            if ($ids->count() <= 1) {
                continue;
            }

            $keepId    = $ids->first();
            $removeIds = $ids->skip(1)->values();

            DB::table('products')
                ->whereIn('category_id', $removeIds)
                ->update(['category_id' => $keepId]);

            DB::table('categories')
                ->whereIn('id', $removeIds)
                ->delete();
        }
    }

    public function down(): void
    {
        // one-way data cleanup — cannot reverse
    }
};
