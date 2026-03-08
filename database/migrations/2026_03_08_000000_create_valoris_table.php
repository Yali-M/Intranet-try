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
        Schema::create('valoris', function (Blueprint $table) {
            $table->id();
            $table->string('title');                // Titre de l'action ou de la récompense
            $table->text('description')->nullable();// Description détaillée
            $table->integer('points')->default(0);  // Nombre de points Valoris
            $table->foreignId('user_id')            // Utilisateur lié à cette action
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');
            $table->timestamp('date')->nullable();  // Date de l'action
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valoris');
    }
};
