<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOracamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oracamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desc_item');
            $table->integer('quantidade')->unsigned();
            $table->double('valor_unitario', 20, 2);
            $table->double('valor_total', 20, 2);
            $table->timestamps();

            $table->integer('projeto_id')->unsigned();
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oracamentos');
    }
}
