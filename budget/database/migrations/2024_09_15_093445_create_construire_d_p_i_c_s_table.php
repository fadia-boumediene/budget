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
        Schema::create('construire_d_p_i_c_s', function (Blueprint $table) {
            $table->integer('id_dpic')->primary()->autoIncrement();
            $table->Date('date_creation_dpic');
    
            $table->float('AE_dpic_nv')->nullable();
            $table->float('CP_dpic_nv')->nullable();

            
            $table->integer('id_rff');
            $table->foreign('id_rff')->references('id_rff')->on('r_f_f_s');
           
            
            $table->integer('id_rp');
            $table->foreign('id_rp')->references('id_rp')->on('respo__progs');
           
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('construire_d_p_i_c_s');
    }
};
