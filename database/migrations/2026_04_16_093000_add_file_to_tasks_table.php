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
        // securise la migration si la colonne existe deja
        if (! Schema::hasColumn('tasks', 'file')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->string('file')->nullable();
            });
        }
    }

    /**
        * Annule les migrations.
     */
    public function down(): void
    {
        // supprime la colonne si elle existe
        if (Schema::hasColumn('tasks', 'file')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->dropColumn('file');
            });
        }
    }
};
