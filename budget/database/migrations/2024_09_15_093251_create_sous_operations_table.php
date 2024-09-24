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
            $table->float('AE_sous_operation')->nullable(); //si t1 ou t4
            $table->float('CP_sous_operation')->nullable();//si t1 ou t4

            $table->DateTime('date_insert_SOUSoperation');
            $table->DateTime('date_update_SOUSoperation')->nullable();

            $table->float('AE_ouvert')->nullable();
            $table->float('AE_atendu')->nullable();
            $table->float('CP_ouvert')->nullable();
            $table->float('CP_atendu')->nullable();


            $table->float('AE_reporte')->nullable();
            $table->float('AE_notifie')->nullable();
            $table->float('AE_engage')->nullable();
            $table->float('CP_reporte')->nullable();
            $table->float('CP_notifie')->nullable();
            $table->float('CP_consome')->nullable();


            $table->integer('code_t1')->nullable();
            $table->foreign('code_t1')->references('code_t1')->on('t1_s');

            $table->integer('code_t2')->nullable();
            $table->foreign('code_t2')->references('code_t2')->on('t2_s');

            $table->integer('code_t3')->nullable();
            $table->foreign('code_t3')->references('code_t3')->on('t3_s');

            $table->integer('code_t4')->nullable();
            $table->foreign('code_t4')->references('code_t4')->on('t4_s');

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
