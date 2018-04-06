<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('instituicao');
            $table->string('cpf')->unique();
            $table->string('area_atuacao');
            $table->string('curso');
            $table->string('funcao');
            $table->boolean('novo')->default(true)->nullable();
            $table->boolean('admin')->default(false)->nullable();
            $table->boolean('liberado')->default(false)->nullable();
            $table->string('token_access')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
