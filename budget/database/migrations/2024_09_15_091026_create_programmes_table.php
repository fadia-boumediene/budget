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
        Schema::create('programmes', function (Blueprint $table) {
            $table->string('num_prog')->primary();
            $table->string('nom_prog');
            $table->string('nom_prog_ar')->nullable();
            $table->float('AE_prog');
            $table->float('CP_prog');

            $table->Date('date_insert_portef');
            $table->Date('date_update_portef')->nullable();
          //  $table->integer('num_journ');


            $table->integer('id_rp');
            $table->foreign('id_rp')->references('id_rp')->on('respo__progs');
            $table->string('num_portefeuil');
            $table->foreign('num_portefeuil')->references('num_portefeuil')->on('portefeuilles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
