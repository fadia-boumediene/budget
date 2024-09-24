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
        Schema::create('construits', function (Blueprint $table) {
            $table->integer('id_construit')->primary();

            $table->integer('id_extrait');
            $table->foreign('id_extrait')->references('id_extrait')->on('extrait__d_p_i_c_s');
           
            
            $table->integer('id_rff');
            $table->foreign('id_rff')->references('id_rff')->on('r_f_f_s');
           
            
            $table->integer('num_action');
            $table->foreign('num_action')->references('num_action')->on('actions');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('construits');
    }
};
