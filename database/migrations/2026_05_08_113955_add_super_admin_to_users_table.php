<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Expand role to support super_admin, reviewer, editor
            // MySQL ENUM can't be easily modified, so we use string with default
            $table->string('permissions')->nullable()->after('role')
                ->comment('JSON encoded extra permissions');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('permissions');
        });
    }
};
