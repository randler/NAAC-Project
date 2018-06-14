@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
    <div class="container text-center">
      <div class="row text-center"> </div>
      <div class="row">
        <div class="col-md-12"> <i class="far fa-4x fa-file"></i>
          @if (isset($editarRelatorio))
            <h1 class="text-center display-3">Editar Relatório - {{$editarRelatorio->titulo}}</h1>
          @else
            <h1 class="text-center display-3">Novo Relatório</h1>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="">Paragraph. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
       @if(isset($editarRelatorio) && ($editarRelatorio->status_relatorio == 'Indeferido' || $editarRelatorio->status_relatorio == 'Recorrigir'))
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-warning" role="alert">
                  <h4 class="alert-heading">{{ $editarRelatorio->parecer_naac }}</h4>
                  <h6>{{$editarRelatorio->correcao}}</h6>
              </div>
            </div>
          </div>
        @endif
    </div>
  </div>
  <div class="py-2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @include('includes.alert.alerts')
        </div>
      </div>
    </div>
  </div>

  <div class="py-1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @if (isset($editarRelatorio))
            {!! Form::model($editarRelatorio, ['route' => ['update-correcao-relatorio', $editarRelatorio->id], 'class' => 'form', 'method' => 'PUT']) !!}
          @else
            {!! Form::open(['route' => 'salvar-relatorio', 'class' => 'form', 'id' => 'form-projeto'])!!}
          @endif 
            <div id="rootwizard">
                <div class="d-none d-sm-block d-md-block d-lg-block d-xl-block navbar col-md-12 text-center">
                    <div class="navbar-inner col-md-12">
                        <div class="container">
                        <ul class="list-inline">
                            <div class="col-md-12 text-center">
                            <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab1" data-toggle="tab" ><i class="fas fa-address-book"></i></a></li>
                            <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab2" data-toggle="tab" ><i class="far fa-calendar-alt"></i></a></li>
                            <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab3" data-toggle="tab" ><i class="fas fa-graduation-cap"></i></a></li>
                            <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab4" data-toggle="tab" ><i class="fas fa-users"></i></a></li>
                            <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab5" data-toggle="tab" id="tab-finish"><i class="fas fa-check-circle"></i></a></li>
                            </div>  
                        </ul>
                        </div>
                    </div>
                </div>  
                <!--div id="bar" class="progress m-3">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div-->
                <br>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Título do projeto</label>
                        <div class="col-sm-10">
                          @if (isset($projeto))
                            {!! Form::hidden('projeto_id', $projeto->id) !!}
                          @endif
                          {!! Form::text('titulo', isset($editarRelatorio) ? null : $projeto->titulo_projeto, ['class' => 'form-control', 'readonly', 'placeholder' => 'Digite o colegiado de origem', 'id' => 'inputColegiado']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Área</label>
                        <div class="col-sm-10">
                            {!! Form::text('area', null, ['class' => 'form-control', 'placeholder' => 'Digite a área', 'id' => 'inputArea']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Subárea</label>
                        <div class="col-sm-10">
                            {!! Form::text('sub_area', null, ['class' => 'form-control', 'placeholder' => 'Digite a subárea', 'id' => 'inputSubArea']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Coordenador do projeto</label>
                        <div class="col-sm-10">
                            {!! Form::text('coordenador_projeto', isset($editarRelatorio) ? null : $projeto->coordenador_projeto, ['class' => 'form-control', 'readonly', 'placeholder' => 'Digite o coordenador', 'id' => 'inputCoordenador']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">CPF</label>
                        <div class="col-sm-10">
                            {!! Form::text('cpf', isset($editarRelatorio) ? null : $projeto->cpf, ['class' => 'form-control', 'readonly', 'placeholder' => 'Digite o cpf do coordenador', 'id' => 'inputCPF']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                        <div class="col-sm-10">
                            {!! Form::number('carga_horaria_evento', isset($editarRelatorio) ? null : $projeto->carga_horaria, ['class' => 'form-control', 'readonly', 'placeholder' => 'Digite a carga horária', 'id' => 'inputCH']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Período de realização</label>
                        <div class="col-sm-10">
                            {!! Form::text('periodo_realizacao', isset($editarRelatorio) ? null : $projeto->periodo_realizacao, ['class' => 'form-control', 'readonly', 'placeholder' => 'Digite o período de realização do eevento', 'id' => 'inputPeriodoRealizacao']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Período abrangido pelo relatório</label>
                        <div class="col-sm-10">
                          {!! Form::text('periodo_abrangido_relatorio', null, ['class' => 'form-control', 'placeholder' => 'Escolha o período abrangido por este relatório', 'id' => 'daterangePeriodoAbrangido']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Objetivo geral</label>
                        <div class="col-sm-10">
                          {!! Form::textarea('objetivo_geral', isset($editarRelatorio) ? null : $projeto->objetivo_geral, ['class' => 'form-control', 'readonly', 'rows' => '3', 'style' =>'resize: none', 'placeholder' => 'Digite o Objetivo geral do projeto', 'id' => 'inputObjetivoGeral']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Objetivos específicos</label>
                        <div class="col-sm-10">
                          {!! Form::textarea('objetivos_especificos', isset($editarRelatorio) ? null : $projeto->objetivos_especificos, ['class' => 'form-control', 'readonly', 'rows' => '3', 'style' =>'resize: none', 'placeholder' => 'Digite os Objetivos específicos do projeto', 'id' => 'inputObjetivoGeral']) !!}
                        </div>
                      </div>
                      <!-- ******************************* FIM DA ABA 1 **************************************************** -->
                    </div>
                    <div class="tab-pane" id="tab2">
                        <br id="content-cronograma-trabalho">
                        <h2 class="text-center">Cronograma de Desenvolvimento do Trabalho</h2>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-left">Descrição da atividade</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputDescAtividade" placeholder="Digite o nome"> </div>
                        </div>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-left">Data</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputDataCronograma" placeholder="Digite a data"> 
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-2 col-form-label"></div>
                          <div class="col-sm-10">
                            <a href="#content-cronograma-trabalho" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputDescAtividade, inputDataCronograma], 'table-cronograma')">Adicionar</a>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-form-label col-md-2 col-lg-2"></div>
                          <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                            <table id="table-cronograma" class="table table-hover table-striped table-responsive">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th class="w-75">Descrição da Atividade</th>
                                  <th class="w-25">Data</th>
                                  <th class="">Ações</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if (isset($editarRelatorio))
                                  @foreach($editarRelatorio->getCronograma as $cronograma)
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$cronograma->desc_atividade}}</td>
                                      <td>{{$cronograma->data}}</td>
                                      <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-cronograma" )'></i></td>
                                    </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                              {!! Form::hidden('table-cronograma', null, ['id' => 'tablecronograma']) !!}
                          </div>
                        </div>
                        <hr>
                        <br>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-left">Resultados Obtidos</label>
                          <div class="col-sm-10">
                            {!! Form::textarea('resultados_obtidos', null, ['class' => 'form-control', 'rows' => '3', 'style' =>'resize: none', 'placeholder' => 'Digite os resultados obtidos', 'id' => 'inputResultadosObtidos']) !!}
                          </div>
                        </div>
                        <!-- ******************************* FIM DA ABA 2 **************************************************** -->
                    </div>
                    <!-- ******************************************** COORDENADORES DO PROJETO *************************************************** -->
                    <div class="tab-pane" id="tab3">
                      <br id="content-coordenador-projeto">
                        <h2 class="text-center">Coordenador(es) do Projeto</h2>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-left">Nome</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNomeCoordenador" placeholder="Digite o nome do coordenador"> 
                          </div>
                        </div>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputCHCoordenador" placeholder="Digite a carga horaria"> 
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-2 col-form-label"></div>
                          <div class="col-sm-10">
                            <a href="#content-coordenador-projeto" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeCoordenador, inputCHCoordenador], 'table-coordenador')">Adicionar</a>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-form-label col-md-2 col-lg-2"></div>
                          <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                            <table id="table-coordenador" class="table table-hover table-striped table-responsive">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th class="w-75">Nome do coordenador</th>
                                  <th class="w-25" value="CH">Carga horária</th>
                                  <th class="">Ações</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if (isset($editarRelatorio))
                                  @foreach($editarRelatorio->getCoordenador as $coordenador)
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$coordenador->nome}}</td>
                                      <td>{{$coordenador->carga_horaria}}</td>
                                      <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-coordenador" )'></i></td>
                                    </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                              {!! Form::hidden('table-coordenador', null, ['id' => 'tablecoordenador']) !!}
                          </div>
                        </div>
                        <hr>
                        <!-- ******************************************** EQUIPE ORGANIZADORA *************************************************** -->
                        <br id="content-Equipe">
                        <h3 class="text-center">Equipe Organizadora</h3>
                        <div class="form-group row">
                          <div class="form-check col-12 text-left">
                            <div class="col-md-2">
                                {!! Form::checkbox('inlineCheckEquipeOrganizadora', null, (isset($editarRelatorio) && count($editarRelatorio->getEquipeRelatorio) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckEquipeOrganizadora']) !!}
                            </div>
                            <div class="col-md-4"> <label class="form-check-label" for="defaultCheckEquipeOrganizadora">
                              Não se aplica
                            </label> </div>
                          </div>
                        </div>
                        <hr>
                        <div id="hide-equipe-organizadora">
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Nome</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputNomeEquipe" placeholder="Digite o nome" > 
                            </div>
                          </div>
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="inputCHEquipe" placeholder="Digite a carga horária" > 
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-2 col-form-label"></div>
                              <div class="col-sm-10">
                                  <a href="#content-Equipe" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeEquipe, inputCHEquipe], 'table-equipe_organizadora')">Adicionar</a>
                              </div>
                            </div>
                          <div class="form-group row">
                            <div class="col-form-label col-md-2 col-lg-2"></div>
                            <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                              <table id="table-equipe_organizadora" class="table table-hover table-striped table-responsive">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th class="w-75">Nome</th>
                                    <th class="w-25">Carga horária</th>
                                    <th class="">Ações</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if (isset($editarRelatorio))
                                    @foreach($editarRelatorio->getEquipeRelatorio as $equipe)
                                      <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$equipe->nome}}</td>
                                        <td>{{$equipe->carga_horaria}}</td>
                                        <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-equipe_organizadora" )'></i></td>
                                      </tr>
                                    @endforeach
                                  @endif
                                </tbody>
                              </table>
                              {!! Form::hidden('table-equipe_organizadora', null, ['id' => 'tableequipe_organizadora']) !!}
                            </div>
                          </div>
                        </div>
                        <!-- ******************************************** PALESTRANTES *************************************************** -->
                        <br id="content-palestrantes">
                        <h3 class="text-center">Palestrantes </h3>
                        <div class="form-group row">
                          <div class="form-check col-12 text-left">
                            <div class="col-md-2">
                                {!! Form::checkbox('inlineCheckPalestrantes', null, (isset($editarRelatorio) && count($editarRelatorio->getPalestrante) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckPalestrantes']) !!}
                            </div>
                            <div class="col-md-4"> <label class="form-check-label" for="defaultCheckPalestrantes">
                              Não se aplica
                            </label> </div>
                          </div>
                        </div>
                        <hr>
                        <div id="hide-palestrantes">
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Nome</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputNomePalestrante" placeholder="Digite o nome" > 
                            </div>
                          </div>
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Título</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputTituloPalestrante" placeholder="Digite o título" > 
                            </div>
                          </div>
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="inputCHPalestrante" placeholder="Digite a carga horária" > 
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-2 col-form-label"></div>
                              <div class="col-sm-10">
                                  <a href="#content-palestrantes" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomePalestrante, inputTituloPalestrante, inputCHPalestrante], 'table-palestrantes')">Adicionar</a>
                              </div>
                            </div>
                          <div class="form-group row">
                            <div class="col-form-label col-md-2 col-lg-2"></div>
                            <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                              <table id="table-palestrantes" class="table table-hover table-striped table-responsive">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th class="w-50">Nome</th>
                                    <th class="w-25">Título</th>
                                    <th class="w-25">Carga horária</th>
                                    <th class="">Ações</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if (isset($editarRelatorio))
                                    @foreach($editarRelatorio->getPalestrante as $palestrante)
                                      <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$palestrante->nome}}</td>
                                        <td>{{$palestrante->titulo}}</td>
                                        <td>{{$palestrante->carga_horaria}}</td>
                                        <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-palestrantes" )'></i></td>
                                      </tr>
                                    @endforeach
                                  @endif
                                </tbody>
                              </table>
                              {!! Form::hidden('table-palestrantes', null, ['id' => 'tablepalestrantes']) !!}
                            </div>
                          </div>
                        </div>
                        <!-- ******************************************** MONITORES *************************************************** -->
                        <br id="content-monitores">
                        <h3 class="text-center">Monitores</h3>
                        <div class="form-group row">
                          <div class="form-check col-12 text-left">
                            <div class="col-md-2">
                                {!! Form::checkbox('inlineCheckMonitores', null, (isset($editarRelatorio) && count($editarRelatorio->getMonitor) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckMonitores']) !!}
                            </div>
                            <div class="col-md-4"> <label class="form-check-label" for="defaultCheckMonitores">
                              Não se aplica
                            </label> </div>
                          </div>
                        </div>
                        <hr>
                        <div id="hide-monitores">
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Nome</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputNomeMonitores" placeholder="Digite o nome" > 
                            </div>
                          </div>
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="inputCHMonitores" placeholder="Digite a carga horária" > 
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-2 col-form-label"></div>
                              <div class="col-sm-10">
                                  <a href="#content-monitores" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeMonitores, inputCHMonitores], 'table-monitores')">Adicionar</a>
                              </div>
                            </div>
                          <div class="form-group row">
                            <div class="col-form-label col-md-2 col-lg-2"></div>
                            <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0">
                              <table id="table-monitores" class="table table-hover table-striped table-responsive">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th class="w-75">Nome</th>
                                    <th class="w-25">Carga horária</th>
                                    <th class="">Ações</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if (isset($editarRelatorio))
                                    @foreach($editarRelatorio->getMonitor as $monitor)
                                      <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$monitor->nome}}</td>
                                        <td>{{$monitor->carga_horaria}}</td>
                                        <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-monitores" )'></i></td>
                                      </tr>
                                    @endforeach
                                  @endif
                                </tbody>
                              </table>
                              {!! Form::hidden('table-monitores', null, ['id' => 'tablemonitores']) !!}
                            </div>
                          </div>
                        </div>
                        <!-- ************************ EXPOSITORES ************************* -->
                        <br id="content-expositores">
                        <h3 class="text-center">Expositores </h3>
                        <div class="form-group row">
                          <div class="form-check col-12 text-left">
                            <div class="col-md-2">
                                {!! Form::checkbox('inlineCheckExpositores', null, (isset($editarRelatorio) && count($editarRelatorio->getExpositor) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckExpositores']) !!}
                            </div>
                            <div class="col-md-4"> <label class="form-check-label" for="defaultCheckExpositores">
                              Não se aplica
                            </label> </div>
                          </div>
                        </div>
                        <hr>
                        <div id="hide-expositores">
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Nome</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputNomeExpositores" placeholder="Digite o nome" > 
                            </div>
                          </div>
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Título</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputTituloExpositores" placeholder="Digite o título" > 
                            </div>
                          </div>
                          <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="inputCHExpositores" placeholder="Digite a carga horária" > 
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-2 col-form-label"></div>
                              <div class="col-sm-10">
                                  <a href="#content-expositores" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeExpositores, inputTituloExpositores, inputCHExpositores], 'table-expositores')">Adicionar</a>
                              </div>
                            </div>
                          <div class="form-group row">
                            <div class="col-form-label col-md-2 col-lg-2"></div>
                            <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                              <table id="table-expositores" class="table table-hover table-striped table-responsive">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th class="w-50">Nome</th>
                                    <th class="w-25">Título</th>
                                    <th class="w-25">Carga horária</th>
                                    <th class="">Ações</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if (isset($editarRelatorio))
                                    @foreach($editarRelatorio->getExpositor as $expositor)
                                      <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$expositor->nome}}</td>
                                        <td>{{$expositor->titulo}}</td>
                                        <td>{{$expositor->carga_horaria}}</td>
                                        <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-expositores" )'></i></td>
                                      </tr>
                                    @endforeach
                                  @endif
                                </tbody>
                              </table>
                              {!! Form::hidden('table-expositores', null, ['id' => 'tableexpositores']) !!}
                            </div>
                          </div>
                        </div>
                        <!-- ******************************* FIM DA ABA 4 **************************************************** -->
                    </div>
                    <div class="tab-pane" id="tab4">
                      <!-- ************************ MINISTRANTES ************************* -->
                      <br id="content-ministrantes">
                      <h3 class="text-center">Ministrantes</h3>
                      <div class="form-group row">
                        <div class="form-check col-12 text-left">
                          <div class="col-md-2">
                              {!! Form::checkbox('inlineCheckMinistrantes', null, (isset($editarRelatorio) && count($editarRelatorio->getMinistrante) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckMinistrantes']) !!}
                          </div>
                          <div class="col-md-4"> <label class="form-check-label" for="defaultCheckMinistrantes">
                            Não se aplica
                          </label> </div>
                        </div>
                      </div>
                      <hr>
                      <div id="hide-ministrantes">
                        <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Nome</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNomeMinistrantes" placeholder="Digite o nome" > 
                          </div>
                        </div>
                        <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Título</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputTituloMinistrantes" placeholder="Digite o título" > 
                          </div>
                        </div>
                        <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputCHMinistrantes" placeholder="Digite a carga horária" > 
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 col-form-label"></div>
                            <div class="col-sm-10">
                                <a href="#content-ministrantes" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeMinistrantes, inputTituloMinistrantes, inputCHMinistrantes], 'table-ministrantes')">Adicionar</a>
                            </div>
                          </div>
                        <div class="form-group row">
                          <div class="col-form-label col-md-2 col-lg-2"></div>
                          <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                            <table id="table-ministrantes" class="table table-hover table-striped table-responsive">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th class="w-50">Nome</th>
                                  <th class="w-25">Título</th>
                                  <th class="w-25">Carga horária</th>
                                  <th class="">Ações</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if (isset($editarRelatorio))
                                  @foreach($editarRelatorio->getMinistrante as $ministrante)
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$ministrante->nome}}</td>
                                      <td>{{$ministrante->titulo}}</td>
                                      <td>{{$ministrante->carga_horaria}}</td>
                                      <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-ministrantes" )'></i></td>
                                    </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                            {!! Form::hidden('table-ministrantes', null, ['id' => 'tableministrantes']) !!}
                          </div>
                        </div>
                      </div>
                      <!-- ************************ PARTICIPANTES ************************* -->
                      <br id="content-participantes">
                      <h3 class="text-center">Participantes</h3>
                      <div class="form-group row">
                        <div class="form-check col-12 text-left">
                          <div class="col-md-2">
                              {!! Form::checkbox('inlineCheckParticipantes', null, (isset($editarRelatorio) && count($editarRelatorio->getParticipante) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckParticipantes']) !!}
                          </div>
                          <div class="col-md-4"> <label class="form-check-label" for="defaultCheckParticipantes">
                            Não se aplica
                          </label> </div>
                        </div>
                      </div>
                      <hr>
                      <div id="hide-participantes">
                        <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Nome</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNomeParticipantes" placeholder="Digite o nome" > 
                          </div>
                        </div>
                        <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputCHParticipantes" placeholder="Digite a carga horária" > 
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 col-form-label"></div>
                            <div class="col-sm-10">
                                <a href="#content-participantes" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeParticipantes, inputCHParticipantes], 'table-participantes')">Adicionar</a>
                            </div>
                          </div>
                        <div class="form-group row">
                          <div class="col-form-label col-md-2 col-lg-2"></div>
                          <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                            <table id="table-participantes" class="table table-hover table-striped table-responsive">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th class="w-75">Nome</th>
                                  <th class="w-25">Carga horária</th>
                                  <th class="">Ações</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if (isset($editarRelatorio))
                                  @foreach($editarRelatorio->getParticipante as $participante)
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$participante->nome}}</td>
                                      <td>{{$participante->carga_horaria}}</td>
                                      <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-participantes" )'></i></td>
                                    </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                            {!! Form::hidden('table-participantes', null, ['id' => 'tableparticipantes']) !!}
                          </div>
                        </div>
                      </div>
                       <!-- ************************ OUVINTES ************************* -->
                       <br id="content-ouvintes">
                       <h3 class="text-center">Ouvintes</h3>
                       <div class="form-group row">
                         <div class="form-check col-12 text-left">
                           <div class="col-md-2">
                               {!! Form::checkbox('inlineCheckOuvintes', null, (isset($editarRelatorio) && count($editarRelatorio->getOuvinte) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckOuvintes']) !!}
                           </div>
                           <div class="col-md-4"> <label class="form-check-label" for="defaultCheckOuvintes">
                             Não se aplica
                           </label> </div>
                         </div>
                       </div>
                       <hr>
                       <div id="hide-ouvintes">
                         <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Nome</label>
                           <div class="col-sm-10">
                             <input type="text" class="form-control" id="inputNomeOuvintes" placeholder="Digite o nome" > 
                           </div>
                         </div>
                         <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Carga horária</label>
                           <div class="col-sm-10">
                             <input type="number" class="form-control" id="inputCHOuvintes" placeholder="Digite a carga horária" > 
                           </div>
                         </div>
                         <div class="form-group row">
                             <div class="col-sm-2 col-form-label"></div>
                             <div class="col-sm-10">
                                 <a href="#content-ouvintes" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeOuvintes, inputCHOuvintes], 'table-ouvintes')">Adicionar</a>
                             </div>
                           </div>
                         <div class="form-group row">
                           <div class="col-form-label col-md-2 col-lg-2"></div>
                           <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                             <table id="table-ouvintes" class="table table-hover table-striped table-responsive">
                               <thead>
                                 <tr>
                                   <th>#</th>
                                   <th class="w-75">Nome</th>
                                   <th class="w-25">Carga horária</th>
                                   <th class="">Ações</th>
                                 </tr>
                               </thead>
                               <tbody>
                                 @if (isset($editarRelatorio))
                                   @foreach($editarRelatorio->getOuvinte as $ouvinte)
                                     <tr>
                                       <td>{{$loop->iteration}}</td>
                                       <td>{{$ouvinte->nome}}</td>
                                       <td>{{$ouvinte->carga_horaria}}</td>
                                       <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-ouvintes" )'></i></td>
                                     </tr>
                                   @endforeach
                                 @endif
                               </tbody>
                             </table>
                             {!! Form::hidden('table-ouvintes', null, ['id' => 'tableouvintes']) !!}
                           </div>
                         </div>
                       </div>
                      <!-- ******************************* FIM DA ABA 4 **************************************************** -->
                    </div>
                    <div class="tab-pane" id="tab5">
                      <!-- ************************ PARECER DO ORIENTADOR/RESPONSÁVEL INSTITUCIONAL ************************* -->
                      <br id="content-cronograma-trabalho">
                      <h2 class="text-center">Parecer do Orientador/Responsável Institucional</h2>
                      <div class="form-group row"> 
                          <div class="col-sm-3">
                            <label class="col-sm-12 col-form-label text-left">Classificação de desempenho</label>
                          </div>
                          <div class="form-check col-sm-9"> 
                            <div class="m-2 col-sm-12">
                              {!! Form::radio('parecer_responsavel', 'Excelente', true, ['class' => 'm-1 form-check-input', 'id' => 'radioParecerEx']) !!} 
                              <label class="form-check-label" for="radioParecerEx">
                                Excelente 
                              </label>
                            </div>
                            <div class="m-2 col-sm-12">
                              {!! Form::radio('parecer_responsavel', 'Bom', true, ['class' => 'm-1 form-check-input', 'id' => 'radioParecerBom']) !!} 
                              <label class="form-check-label" for="radioParecerBom">
                                Bom 
                              </label>
                            </div>
                            <div class="m-2 col-sm-12">
                              {!! Form::radio('parecer_responsavel', 'Regular', true, ['class' => 'm-1 form-check-input', 'id' => 'radioParecerReg']) !!} 
                              <label class="form-check-label" for="radioParecerReg">
                                Regular
                              </label>
                            </div>
                            <div class="m-2 col-sm-12">
                              {!! Form::radio('parecer_responsavel', 'Insuficiente', true, ['class' => 'm-1 form-check-input', 'id' => 'radioParecerIns']) !!} 
                              <label class="form-check-label" for="radioParecerIns">
                                Insuficiente
                              </label>
                            </div>
                          </div>  

                        </div>
                      <!-- ******************************* FIM DA ABA 5 **************************************************** -->
                    </div>
                      <!-- ************************************ BOTÕES ******************************* -->
                      <hr>
                      <ul class="pager wizard">
                        <div class="row">
                          <div class="text-left col-6 col-sm-6 col-md-6">
                            <li class="list-inline-item previous my-1"><a class="btn btn-danger button-previous" href="#rootwizard"><i class="fas fa-angle-left"></i> Anterior</a></li>
                            <li class="list-inline-item next my-1"><a class="btn btn-success button-next" href="#rootwizard">Próximo <i class="fas fa-angle-right"></i></a></li>
                          </div> 
                          <div class="col-6 col-sm-6 col-md-6 text-right">
                            <a href="{{route('home')}}" class="my-1 btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
                            {!! Form::button('<i class="fa fa-paper-plane"></i> Enviar', ['type' => 'submit', 'class' => 'my-1 btn btn-success', 'id' => 'button-finish']) !!}
                          </div>
                        </div> 
                      </ul>
                </div>
              </div>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

@endsection
@push('styles')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/datepicker/css/daterangepicker.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap-wizard/css/prettify.css')}}">
@endpush

@push('scripts-footer')
<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/datepicker/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/datepicker/js/daterangepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/datepicker/js/demo.js')}}"></script>
        <script src="{{ asset('assets/mask/js/jquery.mask.min.js') }}"></script>

        <script src="{{ asset('assets/bootstrap-wizard/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/bootstrap-wizard/js/jquery.bootstrap.wizard.js') }}"></script>
        <script src="{{ asset('assets/bootstrap-wizard/js/prettify.js') }}"></script>

  <script>
      $(document).ready(function() {
        $('#rootwizard').bootstrapWizard({
          'nextSelector': '.button-next', 
          'previousSelector': '.button-previous',
          onTabShow: function(tab, navigation, index) {
            var $component = navigation.find('li');
            //console.log(navigation.find('li')[index]);
            var $total = $component.length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard .progress-bar').css({width:$percent+'%'});
          }, 
          onTabShow: function (tab, navigation, index) {
            //tab.addClass('active');
            /* *** LIBERARA BOTÃO DE ENVIAR *** */
            var $component = navigation.find('li');
            var $total = $component.length;
            if ((index + 1) == $total) {
              $('#button-finish').removeAttr('disabled');
            } else {
              $('#button-finish').attr('disabled', 'disabled');
            }
          },
          onTabClick: function (tab, navigation, index) { 
            tab.removeClass('active');
          },             
          onNext: function (tab, navigation, index) {
            //tab.addClass('btn-danger');
            /* *** LIBERARA BOTÃO DE ENVIAR *** */
            var $component = navigation.find('li');
            var $total = $component.length;

            if ((index + 1) == $total) {
              $('#button-finish').removeAttr('disabled');
            } else {
              $('#button-finish').attr('disabled', 'disabled');
            }
            tab.removeClass('active');
          },
          onPrevious: function (tab, navigation, index) {
             /* *** LIBERARA BOTÃO DE ENVIAR *** */
             var $component = navigation.find('li');
             var $total = $component.length;

             if ((index + 1) == $total) {
               $('#button-finish').removeAttr('disabled');
             } else {
               $('#button-finish').attr('disabled', 'disabled');
             }
            tab.removeClass('active');
          }
      });
        $('#rootwizard .finish').click(function() {

        });
      });
          $(function() {
            $('#inputDataCronograma').daterangepicker({
              "autoApply": true,
              "locale": {
                  "format": "DD/MM/YYYY",
                  "separator": " à ",
                  "applyLabel": "Definir",
                  "cancelLabel": "Cancelar",
                  "fromLabel": "de",
                  "toLabel": "Para",
                  "customRangeLabel": "Custom",
                  "weekLabel": "W",
                  "daysOfWeek": [
                      "D",
                      "S",
                      "T",
                      "Q",
                      "Q",
                      "S",
                      "S"
                  ],
                  "monthNames": [
                      "Janeiro",
                      "Fevereiro",
                      "Março",
                      "Abril",
                      "Maio",
                      "Junho",
                      "Julho",
                      "Agosto",
                      "Setembro",
                      "Outubro",
                      "Novembro",
                      "Dezembro"
                  ],
                  "firstDay": 0
              },  
              "singleDatePicker": true,
              "showDropdowns": true,
            }, 
            function(start, end, label) {
             /* var years = moment().diff(start, 'years');
                alert("You are " + years + " years old.");*/
            });
        });

          $(function(){
            $('#daterangePeriodoAbrangido').daterangepicker({
            "autoApply": true,
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " à ",
                "applyLabel": "Definir",
                "cancelLabel": "Cancelar",
                "fromLabel": "de",
                "toLabel": "Para",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "D",
                    "S",
                    "T",
                    "Q",
                    "Q",
                    "S",
                    "S"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 0
            },
            "startDate": '{{isset($editarRelatorio->periodo_realizacao) ? $editarRelatorio->periodo_realizacao : date("d/m/Y")}}' ,
            "endDate": '{{isset($editarRelatorio->periodo_realizacao) ? explode(' à ',$editarRelatorio->periodo_realizacao)[1] : ""}}' || new Date(new Date().setDate(new Date().getDate() + 5)),
        }, function(start, end, label) {
        });

       /* $('#inputValorUnitario').mask('#.##0,00', {reverse: true});
        $('#inputTelefoneEquipe').mask('(00) o0000-0000', {
          translation: {
            'o': {pattern: /[0-9]/, optional: true}
          }});*/
      });
    </script>

    <script>
        window.onload = check('defaultCheckEquipeOrganizadora');
        window.onload = check('defaultCheckPalestrantes');
        window.onload = check('defaultCheckMonitores');
        window.onload = check('defaultCheckExpositores');
        window.onload = check('defaultCheckMinistrantes');
        window.onload = check('defaultCheckParticipantes');
        window.onload = check('defaultCheckOuvintes');
      function check(idCheck) {
        var checkBox = document.getElementById(idCheck);
        if( checkBox.checked ) {
          switch(idCheck) {
            case "defaultCheckEquipeOrganizadora":
              document.getElementById('hide-equipe-organizadora').style.display = 'none';
              document.getElementById('tableequipe_organizadora').value = "false"; 
            break;
            case "defaultCheckPalestrantes":
              document.getElementById('hide-palestrantes').style.display = 'none';
              document.getElementById('tablepalestrantes').value = "false";
            break;
            case "defaultCheckMonitores":
              document.getElementById('hide-monitores').style.display = 'none';
              document.getElementById('tablemonitores').value = "false";
            break;
            case "defaultCheckExpositores":
              document.getElementById('hide-expositores').style.display = 'none';
              document.getElementById('tableexpositores').value = "false";
            break;
            case "defaultCheckMinistrantes":
              document.getElementById('hide-ministrantes').style.display = 'none';
              document.getElementById('tableministrantes').value = "false";
            break;
            case "defaultCheckParticipantes":
              document.getElementById('hide-participantes').style.display = 'none';
              document.getElementById('tableparticipantes').value = "false";
            break;
            case "defaultCheckOuvintes":
              document.getElementById('hide-ouvintes').style.display = 'none';
              document.getElementById('tableouvintes').value = "false";
            break;
          }
        } else {
          switch(idCheck) {
            case "defaultCheckEquipeOrganizadora":
              document.getElementById('hide-equipe-organizadora').style.display= 'block';
              if (document.getElementById('tableequipe_organizadora').value == "false") {
                document.getElementById('tableequipe_organizadora').value = ""; 
                removerTudo('table-equipe_organizadora');
              }
            break;
            case "defaultCheckPalestrantes":
              document.getElementById('hide-palestrantes').style.display = 'block';
              if (document.getElementById('tablepalestrantes').value == "false") {
                document.getElementById('tablepalestrantes').value = "";
                removerTudo('table-palestrantes');
              }
            break;
            case "defaultCheckMonitores":
              document.getElementById('hide-monitores').style.display = 'block';
              if (document.getElementById('tablemonitores').value == "false") {
                document.getElementById('tablemonitores').value = "";
                removerTudo('table-monitores');
              }
            break;
            case "defaultCheckExpositores":
              document.getElementById('hide-expositores').style.display = 'block';
              if (document.getElementById('tableexpositores').value == "false") {
                document.getElementById('tableexpositores').value = "";
                removerTudo('table-expositores');
              }
            break;
            case "defaultCheckMinistrantes":
              document.getElementById('hide-ministrantes').style.display = 'block';
              if (document.getElementById('tableministrantes').value == "false") {
                document.getElementById('tableministrantes').value = "";
                removerTudo('table-ministrantes');
              }
            break;
            case "defaultCheckParticipantes":
              document.getElementById('hide-participantes').style.display = 'block';
              if (document.getElementById('tableparticipantes').value == "false") {
                document.getElementById('tableparticipantes').value = "";
                removerTudo('table-participantes');
              }
            break;
            case "defaultCheckOuvintes":
              document.getElementById('hide-ouvintes').style.display = 'block';
              if (document.getElementById('tableouvintes').value == "false") {
                document.getElementById('tableouvintes').value = "";
                removerTudo('table-ouvintes');
              }
            break;
          }
        }
      }
    </script>

    <script>
        //totalGeral = {{isset($editarRelatorio->total_geral) ? $editarRelatorio->total_geral : 0.0 }};

          function preencheTabela(array, idTabela) 
          {
            for (var i = 0; i < array.length; i++) {
              if (array[i].value == "") {
                alert("preencha os campos corretamente para adicionar");
                return ;
              }
            }
            dadosTabela = '';
            // Captura a referência da tabela com id “minhaTabela”
            var table = document.getElementById(idTabela);
            // Captura a quantidade de linhas já existentes na tabela
            var numOfRows = table.rows.length;
            // Captura a quantidade de colunas da última linha da tabela
            var numOfCols = table.rows[numOfRows-1].cells.length;
            // Insere uma linha no fim da tabela.
            var newRow = table.insertRow(numOfRows);
            // Faz um loop para criar as colunas
            for (var j = 0; j < numOfCols; j++) {
                // Insere uma coluna na nova linha 
                newCell = newRow.insertCell(j);
                
                if ( j == 0 ) {
                  newCell.innerHTML = numOfRows;
                } else if (j > 0  && j < (numOfCols-1) && j <= array.length){
                  dadosTabela += array[j-1].value + '|'; 
                  if (array[j-1].id.includes('CH'))
                    newCell.innerHTML = array[j-1].value;
                  else
                    newCell.innerHTML = array[j-1].value;
                } else if (j == (numOfCols-1)) {
                  newCell.innerHTML = "<i class='fa fa-trash text-danger' onClick='remover(" + numOfRows + ", \"" + idTabela + "\")'></i>";
                }
                // Insere um conteúdo na coluna
                
            }
            var inputTable = document.getElementById(idTabela.replace("-", "")).value += dadosTabela; 
            if (inputTable.value == 'false')
              inputTable.value = '';
            inputTable.value += dadosTabela;
            this.limparInput(array)

          }

          function remover(row, tableID){              
            dadosTabela = '';
            var rows = document.getElementById(tableID).getElementsByTagName("tr");            
              for (var j = 1; j < rows.length; j++) {
                var cells = rows[j].getElementsByTagName("td");
                for (var i = 0; i < cells.length; i++) {
                  if (cells[i].innerHTML == row ) {
                    document.getElementById(tableID).deleteRow(j);
                    row = - 1;
                    j --;
                    i = cells.length;
                  } else {
                    if(i == 0 && row == -1) {
                      cells[i].innerHTML = j;
                    }
                    if (i > 0 && i < (cells.length - 1)){
                      dadosTabela += cells[i].innerHTML + '|'; 
                    } else if (i == (cells.length - 1)) {
                      cells[i].innerHTML = "<i class='fa fa-trash text-danger' onClick='remover(" + j + ", \"" + tableID + "\")'></i>";
                    }
                  }
                }
              }
            document.getElementById(tableID.replace("-", "")).value = dadosTabela; 
          }

          function limparInput(array) {
            for (var i = 0; i < array.length; i++) 
              document.getElementById(array[i].id).value = null;
          }

          function removerTudo(tableID){  
            var rows = document.getElementById(tableID).getElementsByTagName("tr");            
              for (var j = 1; j < rows.length; j++) {
                    document.getElementById(tableID).deleteRow(j);
              } 
          }

      </script>
@endpush