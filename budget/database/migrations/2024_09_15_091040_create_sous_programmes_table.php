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
            $table->string('num_sous_prog')->primary();
            $table->string('nom_sous_prog');
            $table->string('nom_sous_prog_ar')->nullable();
<<<<<<< HEAD
            $table->float('AE_sous_prog');
=======
           $table->float('AE_sous_porg');
>>>>>>> 663e38df250acaae8a9aa004b07ea890c49201c3
            $table->float('CP_sous_prog');

            $table->DateTime('date_insert_sousProg');
            $table->DateTime('date_update_sousProg')->nullable();



            $table->string('num_prog');
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
