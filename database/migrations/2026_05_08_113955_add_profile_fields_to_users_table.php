<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('role');
            $table->string('institution')->nullable()->after('photo');
            $table->decimal('cgpa', 4, 2)->nullable()->after('institution');
            $table->text('achievements')->nullable()->after('cgpa');
            $table->text('bio')->nullable()->after('achievements');
            $table->string('phone', 20)->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['photo', 'institution', 'cgpa', 'achievements', 'bio', 'phone']);
        });
    }
};
