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
        Schema::create('realisers', function (Blueprint $table) {
          
            $table->integer('id_realiser')->primary();
            $table->date('Date_realiser');
            $table->float('AE_old_realiser');
            $table->float('CP_old_realiser');
            $table->float('AE_nv_realiser');
            $table->float('CP_nv_realiser');

            $table->integer('id_ra');
            $table->foreign('id_ra')->references('id_ra')->on('respo__actions');
           
            $table->integer('id_extrait');
            $table->foreign('id_extrait')->references('id_extrait')->on('extrait__d_p_i_c_s');
           


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisers');
    }
};
