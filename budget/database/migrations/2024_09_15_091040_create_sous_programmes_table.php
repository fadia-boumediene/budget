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
        Schema::create('sous_programmes', function (Blueprint $table) {
            $table->integer('num_sous_prog')->primary();
            $table->string('nom_sous_prog');
            $table->string('nom_sous_prog_ar')->nullable();
           /* $table->float('AE_sous_porg');
            $table->float('CP_sous_prog');
*/
            $table->DateTime('date_insert_sousProg');
            $table->DateTime('date_update_sousProg')->nullable();



            $table->integer('num_prog');
            $table->foreign('num_prog')->references('num_prog')->on('programmes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_programmes');
    }
};
