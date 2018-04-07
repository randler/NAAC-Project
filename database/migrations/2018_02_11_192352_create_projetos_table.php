<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->integer('realtorio_id')->unsigned()->nullable();
            $table->foreign('realtorio_id')->references('id')->on('relatorios')->onDelete('cascade');
            
            // ********************* Dados da tabela projeto *************************
            $table->string  ('titulo_projeto')->unique();
            $table->string  ('colegiado_origem');
            $table->text    ('outros_colegiados');
            $table->text    ('autores');
            $table->text    ('telefones');
            $table->text    ('emails_responsaveis');
            $table->string  ('data_aprovacao_colegiado')->nullable();
            $table->string  ('data_entrada_naac');
            $table->string  ('numero_registro_naac');
            $table->string  ('parecer_naac')->nullable();
            $table->string  ('data_aprovacao_naac')->nullable();
            $table->string  ('nome_coordenador');
            $table->string  ('publico_alvo');
            $table->boolean ('cunho_social');
            $table->string  ('periodo_realizacao');
            $table->string  ('carga_horaria');
            $table->integer ('numero_vagas');
            $table->string  ('dias_horarios_evento');
            $table->string  ('objetivo_geral');
            $table->text    ('objetivos_especificos');
            $table->string  ('justificativa');
            $table->text    ('avaliacao')->nullable();
            $table->text    ('correcao')->nullable();
            $table->text    ('retorno_proposta')->nullable();
            $table->boolean ('has_relatorio')->default(false)->nullable();
            $table->enum    ('status_projeto', ['Enviado', 'Corrigir', 'Deferido', 'Indeferido', 'Reenviado', 'Recorrigir'])->default('Enviado');
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
        Schema::dropIfExists('projetos');
    }
}
