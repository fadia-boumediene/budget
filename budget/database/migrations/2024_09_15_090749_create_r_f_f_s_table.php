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
        Schema::create('r_f_f_s', function (Blueprint $table) {
            $table->integer('id_rff')->primary();
            $table->DateTime('Date_installation_rff');
            $table->integer('id_nin');
            $table->foreign('id_nin')->references('id_nin')->on('personnes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_f_f_s');
    }
};
