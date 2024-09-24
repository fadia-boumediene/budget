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
        Schema::create('group_operations', function (Blueprint $table) {
            $table->integer('code_grp_operation')->primary();
            $table->string('nom_grp_operation');
            $table->string('nom_grp_operation_ar')->nullable();


            $table->DateTime('date_insert_grp_operation');
            $table->DateTime('date_update_grp_operation')->nullable();


            $table->integer('num_sous_action');
            $table->foreign('num_sous_action')->references('num_sous_action')->on('sous_actions');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_operations');
    }
};
