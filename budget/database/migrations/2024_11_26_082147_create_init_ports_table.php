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
        Schema::create('init_ports', function (Blueprint $table) {
            $table->integer('id_init')->primary()->autoIncrement();

            $table->DateTime('date_init');
        

            $table->float('AE_init_t1')->default(0.0);
            $table->float('CP_init_t1')->default(0.0);

            $table->float('AE_init_t2')->default(0.0);
            $table->float('CP_init_t2')->default(0.0);

            $table->float('AE_init_t3')->default(0.0);
            $table->float('CP_init_t3')->default(0.0);

            $table->float('AE_init_t4')->default(0.0);
            $table->float('CP_init_t4')->default(0.0);

            $table->integer('code_t1')->nullable();
            $table->foreign('code_t1')->references('code_t1')->on('t1_s');

            $table->integer('code_t2')->nullable();
            $table->foreign('code_t2')->references('code_t2')->on('t2_s');

            $table->integer('code_t3')->nullable();
            $table->foreign('code_t3')->references('code_t3')->on('t3_s');

            $table->integer('code_t4')->nullable();
            $table->foreign('code_t4')->references('code_t4')->on('t4_s');


            $table->string('num_sous_prog')->nullable();
            $table->foreign('num_sous_prog')->references('num_sous_prog')->on('sous_programmes');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('init_ports');
    }
};
