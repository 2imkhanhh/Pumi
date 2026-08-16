<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('use_1')->nullable();
            $table->text('use_2')->nullable();
            $table->text('use_3')->nullable();
            $table->text('usage_guide')->nullable();
            $table->text('notice')->nullable();
            $table->text('preservation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['use_1', 'use_2', 'use_3', 'usage_guide', 'notice', 'preservation']);
        });
    }
};
