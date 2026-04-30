<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gift_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('capacity_units', 6, 1)->comment('Max size_units this box can hold');
            // MOQ-based tier pricing (box customization cost per unit)
            $table->decimal('price_tier1', 10, 2)->comment('Price per box for 50-99 qty');
            $table->decimal('price_tier2', 10, 2)->comment('Price per box for 100-199 qty');
            $table->decimal('price_tier3', 10, 2)->comment('Price per box for 200-499 qty');
            $table->decimal('price_tier4', 10, 2)->comment('Price per box for 500+ qty');
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_boxes');
    }
};
