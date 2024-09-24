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
        Schema::create('extrait__d_p_i_c_s', function (Blueprint $table) {
            $table->integer('id_extrait')->primary();
            $table->date('Date_extrait');
            $table->integer('delai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extrait__d_p_i_c_s');
    }
};
