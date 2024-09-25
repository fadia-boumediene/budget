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
        Schema::create('t4_s', function (Blueprint $table) {
            $table->integer('code_t4')->primary();
            $table->string('nom_t4');
            $table->string('nom_t4_ar');
        });

        DB::table('t4_s')->insert([
            [

                'code_t4' => 40000,
                'nom_t4' => 'T4',
               'nom_t4_ar' => 'الباب 4'


            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t4_s');
    }
};
