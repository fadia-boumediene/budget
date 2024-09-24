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
        Schema::create('personnes', function (Blueprint $table) {
            $table->integer('id_nin')->primary();
            $table->integer('NSS')->unique();
            $table->string('Nom_per');
            $table->string('Prenom_per');
            $table->string('Nom_ar_per');
            $table->string('Prenom_ar_per');
            $table->date('Date_nais');
            $table->string('Lieu_nais');
            $table->string('Lieu_nais_ar');
            $table->string('adress');
            $table->string('adress_ar');
            $table->integer('num_tlf');
            $table->string('mail_pro');
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnes');
    }
};
