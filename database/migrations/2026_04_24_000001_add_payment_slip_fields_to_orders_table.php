<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table): void {
            $table->string('payment_slip_path')->nullable()->after('notes');
            $table->timestamp('payment_verified_at')->nullable()->after('payment_slip_path');
            $table->string('payment_rejected_reason')->nullable()->after('payment_verified_at');
            $table->timestamp('payment_deadline_at')->nullable()->after('payment_rejected_reason');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table): void {
            $table->dropColumn([
                'payment_slip_path',
                'payment_verified_at',
                'payment_rejected_reason',
                'payment_deadline_at',
            ]);
        });
    }
};
