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
        Schema::create('multimedia', function (Blueprint $table) {
            $table->integer('id_multi')->primary()->autoIncrement();
            $table->string('nom_fichier');
            $table->string('filepath');// chemin
            $table->string('filetype');// pdf || word
            $table->string('description')->nullable();
            $table->integer('size');
            $table->unsignedBigInteger('uploaded_by'); // user id
            $table->string('related_id'); // port || prog || sousProg|| action
            //$table->string('num_portefeuil');
            //$table->string('num_prog');
            //$table->string('num_sous_prog');
            //$table->string('num_action');
            //$table->timestamps();

            //$table->foreign('num_portefeuil')->references('num_portefeuil')->on('portefeuilles');
            //$table->foreign('num_prog')->references('num_prog')->on('programmes');
            //$table->foreign('num_sous_prog')->references('num_sous_prog')->on('sous_programmes');
            //$table->foreign('num_action')->references('num_action')->on('actions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia');
    }
};


