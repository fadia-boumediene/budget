<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->integer('id_art')->primary()->autoIncrement();

            $table->string('nom_art');
            $table->string('nom_art_ar')->nullable();
            $table->Text('description_art')->nullable();
            $table->Text('description_art_ar')->nullable();
            $table->string('code_art'); //reference

        

        });

        DB::table('articles')->insert([
            [

                'nom_art' => "REPORTS DE CP SUR T3 (LIMITE DE 5% )",
                'code_art' => "ART. 36 LOLF",

            ],
            [
                'nom_art' => "REPORTS D'AE NON ENGAGEE SUR T3",
                'code_art' => "ART. 30 LOLF",





            ],
            [
                'nom_art' => "REPORTS D'AE ET DE CP FONDS DE CONCOURS ",
                'code_art' => "ART. 39 LOLF",


            ],

            [
                'nom_art' => "DECRET D'AVANCE ",
                'code_art' => "ART. 27 LOLF",


            ],

            [

                'nom_art' => "REEMPLOI DES CREDITS DEVENUS SANS OBJET",
                'code_art' => "ART. 26 LOLF",

            ],

            [
                'nom_art' => "VIREMENTS",
                'code_art' => "ART. 33  LOLF",


            ],

            [

                'nom_art' => "TRANSFERTS ",
                'code_art' => "ART. 33 LOLF",

            ],
            

            [

                'nom_art' => "AUTRES ",
                'code_art' => "A PRECISE LE CAS ECHEANT",

            ],
        ]) ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
