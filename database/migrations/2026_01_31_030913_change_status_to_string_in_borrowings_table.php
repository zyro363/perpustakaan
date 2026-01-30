<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE borrowings MODIFY COLUMN status VARCHAR(255) NOT NULL DEFAULT 'dipinjam'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We won't revert to ENUM strictly as it might lose data if not careful, 
        // effectively this keeps it flexible.
    }
};
