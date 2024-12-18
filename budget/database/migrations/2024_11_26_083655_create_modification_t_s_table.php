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
        Schema::create('modification_t_s', function (Blueprint $table) {
            
            $table->integer('id_modif')->primary()->autoIncrement();

            $table->DateTime('date_modif');
            $table->string('action_modifie');
        
          

            $table->float('AE_envoi_t1')->default(0.0);
            $table->float('CP_envoi_t1')->default(0.0);

            $table->float('AE_envoi_t2')->default(0.0);
            $table->float('CP_envoi_t2')->default(0.0);

            $table->float('AE_envoi_t3')->default(0.0);
            $table->float('CP_envoi_t3')->default(0.0);

            $table->float('AE_envoi_t4')->default(0.0);
            $table->float('CP_envoi_t4')->default(0.0);

            
            $table->float('AE_recoit_t1')->default(0.0);
            $table->float('CP_recoit_t1')->default(0.0);

            $table->float('AE_recoit_t2')->default(0.0);
            $table->float('CP_recoit_t2')->default(0.0);

            $table->float('AE_recoit_t3')->default(0.0);
            $table->float('CP_recoit_t3')->default(0.0);

            $table->float('AE_recoit_t4')->default(0.0);
            $table->float('CP_recoit_t4')->default(0.0);

            $table->string('situation_modif'); //incomplète ou complète (concernant dpia ou juste sous prog)
            $table->string('type_modif'); //modif interieure entre les t ou exterieurs hors par ex du ministere à cndpi=exter et entre t1 t2 ex =inter


            $table->integer('code_t1')->nullable();
            $table->foreign('code_t1')->references('code_t1')->on('t1_s');

            $table->integer('code_t2')->nullable();
            $table->foreign('code_t2')->references('code_t2')->on('t2_s');

            $table->integer('code_t3')->nullable();
            $table->foreign('code_t3')->references('code_t3')->on('t3_s');

            $table->integer('code_t4')->nullable();
            $table->foreign('code_t4')->references('code_t4')->on('t4_s');

            $table->integer('id_art')->nullable();
            $table->foreign('id_art')->references('id_art')->on('articles');

            $table->string('num_sous_prog')->nullable();
            $table->foreign('num_sous_prog')->references('num_sous_prog')->on('sous_programmes');

            $table->string('num_prog');
            $table->foreign('num_prog')->references('num_prog')->on('programmes');

            $table->string('num_sous_prog_retire')->nullable();
            $table->foreign('num_sous_prog_retire')->references('num_sous_prog')->on('sous_programmes');

            $table->string('num_prog_retire')->nullable();
            $table->foreign('num_prog_retire')->references('num_prog')->on('programmes');
           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modification_t_s');
    }
};
