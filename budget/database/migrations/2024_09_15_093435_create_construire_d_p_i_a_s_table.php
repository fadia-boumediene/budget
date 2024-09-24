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
        Schema::create('construire_d_p_i_a_s', function (Blueprint $table) {
            $table->integer('id_dpia')->primary();
            $table->Date('date_creation_dpia');
            $table->Date('date_modification_dpia');
            $table->string('motif_dpia');
            $table->float('AE_dpia_nv');
            $table->float('CP_dpia_nv');

            
            $table->integer('code_operation');
            $table->foreign('code_operation')->references('code_operation')->on('operations');
           
            
            $table->integer('id_rp');
            $table->foreign('id_rp')->references('id_rp')->on('respo__progs');
           
            
            $table->integer('id_ra');
            $table->foreign('id_ra')->references('id_ra')->on('respo__actions');
           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('construire_d_p_i_a_s');
    }
};
