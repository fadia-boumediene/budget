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
        Schema::create('personnes', function (Blueprint $table) {
            $table->integer('id_nin')->primary();
            $table->integer('NSS')->unique();
            $table->string('Nom_per');
            $table->string('Prenom_per');
            $table->string('Nom_ar_per');
            $table->string('Prenom_ar_per');
            $table->date('Date_nais');
            $table->string('Lieu_nais');
            $table->string('Lieu_nais_ar');
            $table->string('adress');
            $table->string('adress_ar');
            $table->integer('num_tlf');
            $table->string('mail_pro');

        });
        DB::table('personnes')->insert([
            [

                'id_nin' => 1,
                'NSS' => 2,
                'Nom_per' => 'Boumediene',
                'Prenom_per' => 'Fadia',
                'Nom_ar_per' => 'بومدين',
                'Prenom_ar_per' => 'فادية',
               'Date_nais' => '2000-04-14',
               'Lieu_nais' => 'alger',
               'Lieu_nais_ar' => 'الجزائر',
               'adress'=>'alger',
               'adress_ar'=>'الجزائر',
               'num_tlf'=>65852145,
               'mail_pro'=>'dev@mcomm.gov'


            ],
            [

                'id_nin' => 2,
                'NSS' => 3,
                'Nom_per' => 'Sayah',
                'Prenom_per' => 'Nour El-Houda',
                'Nom_ar_per' => 'سايح',
                'Prenom_ar_per' => 'نور الهودى',
               'Date_nais' => '1998-
               -19',
               'Lieu_nais_ar' => 'الجزائر',
               'Lieu_nais' => 'alger',
               'adress'=>'alger',
               'adress_ar'=>'الجزائر',
               'num_tlf'=>66852145,
               'mail_pro'=>'dev0@mcomm.gov'


            ],
            [

                'id_nin' => 3,
                'NSS' => 4,
                'Nom_per' => 'Seddikie',
                'Prenom_per' => 'Souhila',
                'Nom_ar_per' => 'صديقي',
                'Prenom_ar_per' => 'سهيلة',
               'Date_nais' => '1986-02-21',
               'Lieu_nais_ar' => 'الجزائر',
               'Lieu_nais' => 'alger',
               'adress'=>'alger',
               'adress_ar'=>'الجزائر',
               'num_tlf'=>67852145,
               'mail_pro'=>'dev1@mcomm.gov'


            ],
        ]) ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnes');
    }
};
