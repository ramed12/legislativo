<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiliacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filiacoes', function (Blueprint $table) {
            $table->id();
            $table->string('id_api')->nullable();
            $table->integer('nano_id')->nullable();
            $table->date('inicio')->nullable();
            $table->date('fim')->nullable();
            $table->json('partido')->nullable();
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
        Schema::dropIfExists('filiacoes');
    }
}
