<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
        * Execute les migrations.
     */
    public function up(): void
    {
        // evite de planter si la colonne existe deja
        if (! Schema::hasColumn('users', 'branche')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('branche')->nullable()->after('password');
            });
        }
    }

    /**
        * Annule les migrations.
     */
    public function down(): void
    {
        // supprime la colonne si elle existe
        if (Schema::hasColumn('users', 'branche')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('branche');
            });
        }
    }
};
