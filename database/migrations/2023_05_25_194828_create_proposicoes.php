<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposicoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposicoes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_api')->nullable();
            $table->string('tipo')->nullable();
            $table->integer('nano_id')->nullable(); // id do deputado
            $table->json('coautores')->nullable();
            $table->text('ementa')->nullable();
            $table->string('codigo')->nullable();
            $table->string('arquivo')->nullable();
            $table->date('data_leitura')->nullable();
            $table->date('data_fim')->nullable();
            $table->json('processo')->nullable();
            $table->json('conteudo')->nullable();
            $table->json('justificativa')->nullable();
            $table->json('anexos')->nullable();
            $table->string('url')->nullable();
            $table->json('protocoloP')->nullable();
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
        Schema::dropIfExists('proposicoes');
    }
}
