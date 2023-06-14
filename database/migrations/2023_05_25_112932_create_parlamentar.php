<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParlamentar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parlamentar', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->nullable();
            $table->string("cpf", 12)->nullable();
            $table->date("data_nascimento")->nullable();
            $table->string("sexo", 15)->nullable();
            $table->json("cidade_nascimento")->nullable();
            $table->json("estado")->nullable();
            $table->string("fotografia", 255)->nullable();
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
        Schema::dropIfExists('parlamentar');
    }
}
