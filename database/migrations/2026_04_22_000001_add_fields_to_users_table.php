<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 11)->nullable()->after('email');
            $table->string('company_name')->nullable()->after('phone');
            $table->string('ntn_number')->nullable()->after('company_name');
            $table->boolean('is_b2b')->default(false)->after('ntn_number');
            $table->boolean('is_verified')->default(false)->after('is_b2b');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'company_name', 'ntn_number', 'is_b2b', 'is_verified']);
        });
    }
};
