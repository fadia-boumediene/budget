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
        Schema::create('respo__actions', function (Blueprint $table) {
            $table->integer('id_ra')->primary();
            $table->date('Date_installation_ra');
            $table->integer('id_nin');
            $table->foreign('id_nin')->references('id_nin')->on('personnes');
  
        });

        DB::table('respo__actions')->insert([
            [
                'id_ra'=>1,
                'Date_installation_ra' => '2024-02-19',
                'id_nin' => 1,
             
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respo__actions');
    }
};
