<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // ********************* Dados da tabela realtorio *************************
            $table->string  ('titulo');
            $table->string  ('area');
            $table->string  ('sub_area');
            $table->string  ('coordenador_projeto');
            $table->string  ('cpf');
            $table->integer ('carga_horaria_evento');
            $table->string  ('periodo_realizacao');
            $table->string  ('periodo_abrangido_relatorio');
            $table->string  ('objetivo_geral');
            $table->string  ('objetivos_especificos');
            $table->text    ('resultados_obtidos');
            $table->text    ('parecer_naac')->nullable();
            $table->text    ('correcao')->nullable();
            $table->enum    ('parecer_responsavel', ['Excelente', 'Bom', 'Regular', 'Insuficiente']);
            $table->enum    ('status_relatorio', ['Enviado', 'Corrigir', 'Deferido', 'Indeferido', 'Reenviado', 'Recorrigir'])->default('Enviado');
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
        Schema::dropIfExists('relatorios');
    }
}
