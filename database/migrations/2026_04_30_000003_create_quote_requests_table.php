<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('gift_box_id')->nullable()->constrained()->nullOnDelete();
            $table->string('gift_box_name');
            $table->unsignedInteger('total_boxes');
            $table->json('items');
            $table->decimal('items_total_per_box', 10, 2);
            $table->decimal('box_price_per_box', 10, 2);
            $table->decimal('grand_total', 10, 2);
            $table->string('status')->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
