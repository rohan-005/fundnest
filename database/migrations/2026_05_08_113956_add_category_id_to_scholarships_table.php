<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            // Add FK constraint now that categories table exists
            if (!Schema::getColumnListing('scholarships') || !in_array('category_id', Schema::getColumnListing('scholarships'))) {
                $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            } else {
                // Column already exists, just add the FK constraint
                $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
