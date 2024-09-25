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
        Schema::create('t2_s', function (Blueprint $table) {
            $table->integer('code_t2')->primary();
            $table->string('nom_t2');
            $table->string('nom_t2_ar');
           
        });
        DB::table('t2_s')->insert([
            [

                'code_t2' => 20000,
                'nom_t2' => 'T2',
               'nom_t2_ar' => 'الباب 2'


            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t2_s');
    }
};
