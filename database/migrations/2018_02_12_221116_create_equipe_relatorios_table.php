<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipeRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipe_relatorios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
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
        Schema::dropIfExists('equipe_relatorios');
    }
}
