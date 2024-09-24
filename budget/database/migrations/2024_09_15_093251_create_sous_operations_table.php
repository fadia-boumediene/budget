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
        Schema::create('sous_operations', function (Blueprint $table) {
            $table->integer('code_sous_operation')->primary();
            $table->string('nom_sous_operation');
            $table->string('nom_sous_operation_ar');
            $table->float('AE_sous_operation');
            $table->float('CP_sous_operation');

            $table->float('AE_ouvert')->nullable();
            $table->float('AE_atendu')->nullable();
            $table->float('CP_ouvert')->nullable();
            $table->float('CP_atendu')->nullable();

            $table->integer('code_operation');
            $table->foreign('code_operation')->references('code_operation')->on('operations');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_operations');
    }
};
