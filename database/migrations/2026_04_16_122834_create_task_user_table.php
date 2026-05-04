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
        // table pivot pour lier taches et utilisateurs
        Schema::create('task_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
        * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_user');
    }
};
