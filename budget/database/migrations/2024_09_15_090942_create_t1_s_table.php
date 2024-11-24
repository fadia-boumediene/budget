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
        Schema::create('t1_s', function (Blueprint $table) {
            $table->integer('code_t1')->primary();
            $table->string('nom_t1');
            $table->string('nom_t1_ar');
           
        });

        DB::table('t1_s')->insert([
            [

                'code_t1' => 10000,
                'nom_t1' => 'T1',
               'nom_t1_ar' => 'الباب 1'


            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t1_s');
    }
};
