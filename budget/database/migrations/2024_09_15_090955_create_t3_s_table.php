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
        Schema::create('t3_s', function (Blueprint $table) {
            $table->integer('code_t3')->primary();
            $table->string('nom_t3');
            $table->string('nom_t3_ar');
        });

        DB::table('t3_s')->insert([
            [

                'code_t3' => 30000,
                'nom_t3' => 'T3',
               'nom_t3_ar' => 'الباب 3'


            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t3_s');
    }
};
