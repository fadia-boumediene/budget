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
        Schema::create('sous_actions', function (Blueprint $table) {
            $table->integer('num_sous_action')->primary();
            $table->string('nom_sous_action');
            $table->string('nom_sous_action_ar')->nullable();
          /*  $table->float('AE_sous_action');
            $table->float('CP_sous_action');
*/
            $table->DateTime('date_insert_sous_action');
            $table->DateTime('date_update_sous_action')->nullable();


            $table->integer('num_action');
            $table->foreign('num_action')->references('num_action')->on('actions');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_actions');
    }
};
