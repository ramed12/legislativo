<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramitacoes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_api');
            $table->integer('id_proposicao');
            $table->string('descricao');
            $table->string('setor');
            $table->json('dataReg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tramitacoes');
    }
}
