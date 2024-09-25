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
        Schema::create('operations', function (Blueprint $table) {
            $table->integer('code_operation')->primary();
            $table->string('nom_operation');
            $table->string('nom_operation_ar');
            

            $table->DateTime('date_insert_operation');
            $table->DateTime('date_update_operation')->nullable();




            $table->integer('code_grp_operation');
            $table->foreign('code_grp_operation')->references('code_grp_operation')->on('group_operations');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
