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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('job_type')->nullable()->after('type');
            $table->string('location')->nullable()->after('job_type');
            $table->string('salary')->nullable()->after('location');
            $table->string('deadline')->nullable()->after('salary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['job_type', 'location', 'salary', 'deadline']);
        });
    }
};
