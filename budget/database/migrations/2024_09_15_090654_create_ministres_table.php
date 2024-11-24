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
        Schema::create('ministres', function (Blueprint $table) {
            $table->integer('id_min')->primary();
            $table->date('Date_installation');
            $table->integer('id_nin');
            $table->foreign('id_nin')->references('id_nin')->on('personnes');
        });

        DB::table('ministres')->insert([
            [
              
                'id_min' => 1,
                'Date_installation' =>'2023-09-14',
                'id_nin' => 2,
                
            ], 
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ministres');
    }
};
