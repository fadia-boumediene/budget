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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');  // Ajout, modification, suppression
            $table->string('model');   // Nom du modèle (par exemple, Operation)
            $table->string('model_id'); // ID de l'enregistrement modifié
            $table->json('original');      // Données de l'enregistrement (avant/après modification)
            $table->json('changed')->nullable();   // Valeurs modifiées lors de la mise à jour
            $table->json('id_art')->nullable();   // la ref de l article
            $table->ipAddress('ip_address'); // Adresse IP de la machine
            $table->timestamps();      // Heures de création et de mise à jour
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
