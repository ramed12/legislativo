<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicencaParlamentar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenca_parlamentar', function (Blueprint $table) {
            $table->id();
            $table->integer("nano_id")->nullable();
            $table->integer("id_api")->nullable();
            $table->date("diario_oficial")->nullable();
            $table->string("motivo")->nullable();
            $table->json("apresentacao")->nullable();
            $table->json("periodo")->nullable();
            $table->json("concessao")->nullable();
            $table->string("observacao")->nullable();
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
        Schema::dropIfExists('licenca_parlamentar');
    }
}
