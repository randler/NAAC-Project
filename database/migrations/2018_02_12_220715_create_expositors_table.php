<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpositorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expositors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('titulo');
            $table->integer('carga_horaria');
            $table->timestamps();

            $table->integer('relatorio_id')->unsigned();
            $table->foreign('relatorio_id')->references('id')->on('relatorios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expositors');
    }
}
