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
        Schema::table('tasks', function (Blueprint $table) {
            // a completer si besoin
        });
    }

    /**
        * Annule les migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // a completer si besoin
        });
    }
};
