@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
  <div class="container text-center">
    <div class="row text-center"> </div>
    <div class="row">
      <div class="col-md-12"> <i class="far fa-4x fa-file"></i>
        @if (isset($dadosProject))
          <h1 class="text-center display-3">Editar Projeto - {{$dadosProject->titulo_projeto}}</h1>
        @else
          <h1 class="text-center display-3">Novo Projeto</h1>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="">Paragraph. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
     @if(isset($dadosProject) && ($dadosProject->status_projeto == 'Indeferido' || $dadosProject->status_projeto == 'Recorrigir'))
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">{{ $dadosProject->parecer_naac }}</h4>
                <h6>{{$dadosProject->correcao}}</h6>
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
        @if (isset($dadosProject))
          {!! Form::model($dadosProject, ['route' => ['update-correcao-projeto', $dadosProject->id], 'class' => 'form', 'method' => 'PUT']) !!}
        @else
          {!! Form::open(['route' => 'save-project', 'class' => 'form', 'id' => 'form-projeto'])!!}
        @endif 
          <div id="rootwizard">
              <div class="d-none d-sm-block d-md-block d-lg-block d-xl-block navbar col-md-12 text-center">
                <div class="navbar-inner col-md-12">
                  <div class="container">
                    <ul class="list-inline">
                      <div class="col-md-12 text-center">
                        <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab1" data-toggle="tab" title="Dados do projeto"><i class="fas fa-address-book"></i></a></li>
                        <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab2" data-toggle="tab" title="Dados da Equipe organizadora"><i class="fas fa-users"></i></a></li>
                        <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab3" data-toggle="tab" title="Conteúdos/Referências & Avaliação"><i class="fas fa-file"></i></a></li>
                        <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab4" data-toggle="tab" title="Parcerias & Orçametos"><i class="fas fa-handshake"></i></a></li>
                        <li class="p-1 col-6 col-sm-2 list-inline-item"><a class="btn-block btn btn-primary" href="#tab5" data-toggle="tab" title="Recursos & Retorno da proposta" id="tab-finish"><i class="fas fa-book"></i></a></li>
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
                        {!! Form::label('titulo_projeto', 'Título do Projeto', ['class' => 'col-12 col-sm-2 col-form-label text-left']) !!}
                        <div class="col-sm-10">
                          {!! Form::text('titulo_projeto', null, ['class' => 'form-control', 'id' => 'inputTitulo', 'placeholder' => 'Digite o título do projeto']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Colegiado de origem</label>
                        <div class="col-sm-10">
                          {!! Form::text('colegiado_origem', old('colegiado_origem'), ['class' => 'form-control', 'placeholder' => 'Digite o colegiado de origem', 'id' => 'inputColegiado']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Outros colegiados</label>
                        <div class="col-sm-10">
                          {!! Form::text('outros_colegiados', null, ['class' => 'form-control', 'placeholder' => 'Digite outros colegiados', 'id' => 'inputOutrosColegiados']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Autores do projeto</label>
                        <div class="col-sm-10">
                          {!! Form::text('autores', null, ['class' => 'form-control', 'placeholder' => 'Digite os autores do projeto (NÃO PODE SER ALUNO)', ' aria-describedby' => 'autorHelpBlock', 'id' => 'inputAutores']) !!}
                          <div> <small class="text-danger" id="inputAutores">* Não pode ser aluno</small> </div>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Telefones</label>
                        <div class="col-sm-10">
                          {!! Form::text('telefones', null, ['class' => 'form-control', 'placeholder' => 'Digite os telefones (SEPARADOS PO VÍRGULA)', ' aria-describedby' => 'autorHelpBlock', 'id' => 'inputAutores']) !!}
                          <div> <small class="text-danger" id="inputAutores">* Separados por vírgula. Ex: (77)98877-6655, (77)98877-6655, (77)98877-6655. </small> </div>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">E-mails</label>
                        <div class="col-sm-10">
                          {!! Form::text('emails_responsaveis', null, ['class' => 'form-control', 'placeholder' => 'Digite os e-mails dos autores', ' aria-describedby' => 'emailsHelpBlock', 'id' => 'inputEmailsAutores']) !!}
                          <div> <small class="text-danger" id="inputEmailsAutores">* Separados por vírgula. Ex: email1@gmail.com, email2@gmail.com</small> </div>
                        </div>
                      </div>
                      @if (isset($dadosProject))
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-right">Data de aprovação do colegiado ou direção do campus</label>
                          <div class="col-sm-10">
                            {!! Form::text('data_aprovacao_colegiado', null, ['class' => 'form-control', 'readonly',  'placeholder' => 'Data de Aprovação', 'id' => 'inputdataAprovacaoColegiado']) !!} 
                          </div>
                        </div>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-right">Data de entrada no NAAC</label>
                          <div class="col-sm-10">
                              {!! Form::text('data_entrada_naac', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'Data de entrada no NAAC', 'id' => 'inputDataEntradaNAAC']) !!} 
                          </div>
                        </div>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-right">Número de registro NAAC</label>
                          <div class="col-sm-10">
                            {!! Form::text('numero_registro_naac', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'Número de registro do NAAC', 'id' => 'inputNumeroRegistro']) !!} 
                          </div>
                        </div>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-right">Parecer NAAC</label>
                          <div class="col-sm-10">
                            {!! Form::text('parecer_naac', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'Parecer do NAAC', 'id' => 'inputParecerNAAC']) !!}  
                          </div>
                        </div>
                        <div class="form-group row"> 
                          <label class="col-sm-2 col-form-label text-right">Data Aprovação NAAC</label>
                          <div class="col-sm-10">
                            {!! Form::text('data_aprovacao_naac', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'Data de aprovação no NAAC', 'id' => 'inputDataAprovacaoNAAC']) !!}  
                          </div>
                        </div>
                      @endif
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Coordenador do projeto</label>
                        <div class="col-sm-10">
                          {!! Form::text('nome_coordenador', null, ['class' => 'form-control', 'placeholder' => 'Digite o coordenador do projeto', 'id' => 'inputCoordenador']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Público Alvo</label>
                        <div class="col-sm-10">
                          {!! Form::text('publico_alvo', null, ['class' => 'form-control', 'placeholder' => 'Digite o público alvo', 'id' => 'inputPublicoAlvo']) !!} 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">de Cunho Social</label>
                        <div class=" col-12 col-sm-4 col-md-3 col-lg-2 ml-3 form-control">
                          <div class="form-check form-check-inline mt-2">
                            {!! Form::radio('cunho_social', (isset($dadosProject->cunho_social) && $dadosProject->cunho_social == 1) ? 1 : 0, ['class' => 'form-check-input ml-1', 'id' => 'inlineRadio1']) !!} 
                            <label class="form-check-label " for="inlineRadio1"> Sim </label> 
                          </div>
                          <div class="form-check form-check-inline mt-2">
                            {!! Form::radio('cunho_social', (isset($dadosProject->cunho_social) && $dadosProject->cunho_social == 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'id' => 'inlineRadio2']) !!}  
                            <label class="form-check-label" for="inlineRadio2"> Não </label> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Período da realização</label>
                        <div class="col-sm-10">
                          {!! Form::text('periodo_realizacao', null, ['class' => 'form-control', 'placeholder' => 'Escolha o período de realização', 'id' => 'daterange']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Carga horária do evento</label>
                        <div class="col-sm-10">
                            {!! Form::number('carga_horaria', null, ['class' => 'col-6 form-control', 'placeholder' => 'Digite a carga horária', ' aria-describedby' => 'chHelpBlock', 'id' => 'inputCH']) !!}
                            <div> <small class="text-danger" id="inputCH">* Mínimo de uma (1) hora</small> </div> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Número de vagas</label>
                        <div class="col-sm-10">
                          {!! Form::number('numero_vagas', null, ['class' => 'col-6 form-control', 'placeholder' => 'Digite o número de vagas', ' aria-describedby' => 'vagasHelpBlock', 'id' => 'inputVagas']) !!}
                          <div> <small class="text-danger" id="inputVagas">* Mínimo de uma (1) vaga</small> </div> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Dias e horarios da realização do evento</label>
                        <div class="col-sm-10">
                          {!! Form::textarea('dias_horarios_evento', null, ['class' => 'form-control', 'placeholder' => 'Digite os dias e horas de relização do evento', 'rows' => '5', 'id' => 'inputDiasHoras']) !!}
                          <div> <span class="text-danger" id="inputDiasHoras">* Separados por vírgula. <b>Ex: Segunda 20:00 - 21:00, Terça 16:00 - 22:00</b></span> </div>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Apresentação/ Justificativa</label>
                        <div class="col-sm-10"> 
                          {!! Form::textarea('justificativa', null, ['class' => 'form-control', 'placeholder' => 'Digite a Apresentação/Justificativa', 'rows' => '5', 'id' => 'inputJustificatva']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Objetivo geral</label>
                        <div class="col-sm-10">
                          {!! Form::text('objetivo_geral', null, ['class' => 'form-control', 'placeholder' => 'Digite o Objetivo geral', 'id' => 'inputObjetivoGeral']) !!}
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Objetivos específicos</label>
                        <div class="col-sm-10">
                          {!! Form::text('objetivos_especificos', null, ['class' => 'form-control', 'placeholder' => 'Digite os Objetivos específicos', 'id' => 'inputObjetivosEspecificos']) !!}
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                      <br id="content-equipe">
                      <h2 class="text-center">Equipe Executora/Organizadora</h2>
                      <div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Nome</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputNomeEquipe" placeholder="Digite o nome"> </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Email</label>
                        <div class="col-sm-5">
                          <input type="email" class="form-control" id="inputEmailEquipe" placeholder="Digite o email"> </div>
                        <div class="col-sm-5">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label text-left">Tel</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="inputTelefoneEquipe" placeholder="Digite o telefone" data-mask="(99) 09999-9999"> </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">
                          <a href="#content-equipe" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeEquipe, inputEmailEquipe, inputTelefoneEquipe], 'table-equipe')">Adicionar</a>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-form-label col-md-2 col-lg-2"></div>
                        <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                          <table id="table-equipe" class="table table-hover table-striped table-responsive">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="w-50">Nome</th>
                                <th class="w-25">E-mail</th>
                                <th class="w-25">Telefone</th>
                                <th class="">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (isset($dadosProject))
                                @foreach($dadosProject->getEquipe as $equipe)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$equipe->nome}}</td>
                                    <td>{{$equipe->email}}</td>
                                    <td>{{$equipe->telefone}}</td>
                                    <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-equipe" )'></i></td>
                                  </tr>
                                @endforeach
                              @endif
                            </tbody>
                          </table>
                            {!! Form::hidden('table-equipe', null, ['id' => 'tableequipe']) !!}
                        </div>
                      </div>
                      <br id="content-criterio">
                      <h3 class="text-center">Critérios para seleção</h3>
                      <div class="form-group row">
                        <div class="form-check col-12 text-left">
                          <div class="col-md-2">
                              {!! Form::checkbox('inlineCheckCriterio', null, (isset($dadosProject) && count($dadosProject->getCriterios) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckCriterios']) !!}
                          </div>
                          <div class="col-md-4"> <label class="form-check-label" for="defaultCheckCriterios">
                            Não se aplica
                          </label> </div>
                        </div>
                      </div>
                      <hr>
                      <div id="hide-criterio">
                      <div  class="form-group row"> <label class="col-sm-2 col-form-label text-left">Critério</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputCriterioEquipe" placeholder="Digite o critério" > 
                        </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-2 col-form-label"></div>
                          <div class="col-sm-10">
                              <a href="#content-criterio" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputCriterioEquipe], 'table-criterio')">Adicionar</a>
                          </div>
                        </div>
                      <div class="form-group row">
                        <div class="col-form-label col-md-2 col-lg-2"></div>
                        <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                          <table id="table-criterio" class="table table-hover table-striped table-responsive">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="w-100">Critério de seleção</th>
                                <th class="">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (isset($dadosProject))
                                @foreach($dadosProject->getCriterios as $criterio)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$criterio->desc_criterio}}</td>
                                    <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-criterio" )'></i></td>
                                  </tr>
                                @endforeach
                              @endif
                            </tbody>
                          </table>
                          {!! Form::hidden('table-criterio', null, ['id' => 'tablecriterio']) !!}
                        </div>
                      </div>
                      <br id="content-documento">
                      <h3 class="text-center">Documentação necessária</h3>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-left">Documento</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputDocumento" placeholder="Digite o documento" > </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">
                            <a href="#content-documento" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputDocumento], 'table-documento')">Adicionar</a>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class=" col-form-label col-md-2 col-lg-2"></div>
                        <div class="ml-0 col-form-label col-12 col-sm-12 col-md-10 col-lg-10">
                          <table id="table-documento" class="table table-hover table-striped table-responsive">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="w-100">Documento</th>
                                <th class="">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (isset($dadosProject))
                                @foreach($dadosProject->getDocumento as $documento)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$documento->desc_documento}}</td>
                                    <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-documento" )'></i></td>
                                  </tr>
                                @endforeach 
                              @endif
                            </tbody>
                          </table>
                          {!! Form::hidden('table-documento', null, ['id' => 'tabledocumento']) !!}
                        </div>
                      </div>
                    </div>
                      <br id="content-atividade">
                      <h3 class="text-center">Atividades previstas</h3>
                      <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Atividade</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputAtividade" placeholder="Digite a atividade" > 
                        </div>
                      </div>
                      <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Título</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputTituloAtividade" placeholder="Digite o título da atividade" > 
                        </div>
                      </div>
                      <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Observação</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputObservacao" placeholder="Digite a observação" > </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-2 col-form-label"></div>
                          <div class="col-sm-10">
                              <a href="#content-atividade" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputAtividade, inputTituloAtividade, inputObservacao], 'table-atividade')">Adicionar</a>
                          </div>
                        </div>
                      <div class="form-group row">
                        <div class="col-form-label col-md-2 col-lg-2"></div>
                        <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                          <table id="table-atividade" class="table table-hover table-striped table-responsive">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="w-50">Atividade</th>
                                <th class="w-50">Título</th>
                                <th class="w-50">Observação</th>
                                <th class="">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (isset($dadosProject))
                                @foreach($dadosProject->getAtividades as $atividade)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$atividade->desc_atividades}}</td>
                                    <td>{{$atividade->titulo_atividade}}</td>
                                    <td>{{$atividade->obs_atividade}}</td>
                                    <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-atividade" )'></i></td>
                                  </tr>
                                @endforeach 
                              @endif
                            </tbody>
                          </table>
                          {!! Form::hidden('table-atividade', null, ['id' => 'tableatividade']) !!}
                        </div>
                      </div>
                      <hr>
                    </div>
                  </div>
                <div class="tab-pane" id="tab3">
                    <br id="content-referencia">
                    <h2 class="text-center">Conteúdos/Referências</h2>
                    <div class="form-group row">
                      <div class="form-check col-12 text-left">
                        <div class="col-md-2">
                            {!! Form::checkbox('inlineCheckConteudo', null, (isset($dadosProject) && count($dadosProject->getConteudos) <= 0) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckConteudo']) !!}
                        </div>
                        <div class="col-md-4"> <label class="form-check-label" for="defaultCheckConteudo">
                          Não se aplica
                        </label> </div>
                      </div>
                    </div>
                    <hr>
                    <div id="hide-referencia">
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Conteúdo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputConteudo" placeholder="Digite o conteúdo"> </div>
                    </div>
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Principais referências</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputReferencia" placeholder="Digite a principal referência" > </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-2 col-form-label"></div>
                      <div class="col-sm-10">
                        <a href="#content-referencia" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputConteudo, inputReferencia], 'table-referencia')">Adicionar</a>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-form-label col-md-2 col-lg-2"></div>
                      <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0 ">
                        <table id="table-referencia" class="table table-hover table-striped table-responsive">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="w-50">Conteúdo</th>
                              <th class="w-50">Referência</th>
                              <th class="">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                             @if (isset($dadosProject))
                                @foreach($dadosProject->getConteudos as $conteudo)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$conteudo->desc_conteudo}}</td>
                                    <td>{{$conteudo->referencia}}</td>
                                    <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-referencia" )'></i></td>
                                  </tr>
                                @endforeach
                              @endif
                          </tbody>
                        </table>
                        {!! Form::hidden('table-referencia', null, ['id' => 'tablereferencia']) !!}
                      </div>
                    </div>
                    <hr>
                  </div>
                    <br>
                    <br>
                    <br id="content-avaliacao">
                    <h2 class="text-center">Avaliação</h2>
                    <div class="form-group row">
                      <div class="form-check col-12 text-left">
                        <div class="col-md-2">
                          {!! Form::checkbox('inlineCheckAvaliacao', null, (isset($dadosProject) && $dadosProject->avaliacao == 'false') ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckAvaliacao']) !!} 
                        </div>
                        <div class="col-md-4"> <label class="form-check-label" for="defaultCheckAvaliacao">
                          Não se aplica
                        </label> </div>
                      </div>
                    </div>
                    <hr>
                    <div id="hide-avaliacao">
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Avaliação</label>
                      <div class="col-sm-10">
                        {!! Form::text('avaliacao', null, ['class' => 'form-control', 'placeholder' => 'Digite a avaliação', 'id' => 'inputAvaliacao']) !!}
                      </div>
                    </div>
                    <hr>
                  </div>
                  </div>
                <div class="tab-pane" id="tab4">
                    <br id="content-parceria">
                    <h2 class="text-center">Quadro de parcerias</h2>
                    <div class="form-group row">
                      <div class="form-check col-12 text-left">
                        <div class="col-md-2">
                          {!! Form::checkbox('inlineCheckParceria', null, (isset($dadosProject) && count($dadosProject->getParcerias) <= 0 ) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckParceria']) !!}  
                        </div>
                        <div class="col-md-4"> <label class="form-check-label" for="defaultCheckParceria">
                          Não se aplica
                        </label> </div>
                      </div>
                    </div>
                    <hr>
                    <div id="hide-parceria">
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Parceria/ Instituição</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputParceria" placeholder="Digite a parceria" > </div>
                    </div>
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Representante</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputRepresentante" placeholder="Digite o representante" > </div>
                      <div class="col-sm-5">
                        <div class="form-group row"> <label class="col-sm-3 col-form-label text-left">Contato</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputContatoRepresentante" placeholder="Digite o contato"> </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-2 col-form-label"></div>
                      <div class="col-sm-10">
                        <a href="#content-parceria" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputParceria, inputRepresentante, inputContatoRepresentante], 'table-parceria')">Adicionar</a>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-form-label col-md-2 col-2 col-lg-2"></div>
                      <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0">
                        <table id="table-parceria" class="table table-hover table-striped table-responsive">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="w-50">Parceria</th>
                              <th class="w-25">Representante</th>
                              <th class="w-25">Contato</th>
                              <th class="">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                             @if (isset($dadosProject))
                                @foreach($dadosProject->getParcerias as $parceria)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$parceria->desc_parceria}}</td>
                                    <td>{{$parceria->representante}}</td>
                                    <td>{{$parceria->contato}}</td>
                                    <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-parceria" )'></i></td>
                                  </tr>
                                @endforeach
                              @endif
                          </tbody>
                        </table>
                        {!! Form::hidden('table-parceria', null, ['id' => 'tableparceria']) !!}
                      </div>
                    </div>
                    <hr>
                  </div>
                    <br>
                    <br>
                    <br id="content-orcamento">
                    <h2 class="text-center">Orçamento (Custos Envolvidos)</h2>
                    <div class="form-group row">
                      <div class="form-check col-12 text-left">
                        <div class="col-md-2">
                          {!! Form::checkbox('inlineCheckOrcamento', null, (isset($dadosProject) && count($dadosProject->getOrcamentos) <= 0 ) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckOrcamento']) !!}
                        </div>
                        <div class="col-md-4"> <label class="form-check-label" for="defaultCheckOrcamento">
                          Não se aplica
                        </label> </div>
                      </div>
                    </div>
                    <hr>
                    <div id="hide-orcamento">
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Ítem a ser orçado</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputItemOrcado" placeholder="Digite o ítem a ser orçado"> </div>
                    </div>
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Quantidade</label>
                      <div class="col-sm-4">
                        <input type="number" class="form-control" id="inputQuantidade" placeholder="Digite a quantidade" data-mask="9999"> </div>
                      <div class="col-sm-6">
                        <div class="form-group row"> <label class="col-sm-3 col-form-label text-left">Valor unitário</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputValorUnitario" placeholder="Digite o valor unitário" data-mask="##.##0,00" > </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-2 col-form-label"></div>
                      <div class="col-sm-10">
                        <a href="#content-orcamento" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputItemOrcado, inputQuantidade, inputValorUnitario], 'table-orcamento')">Adicionar</a>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-form-label col-md-2 col-lg-2"></div>
                      <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0">
                        <table id="table-orcamento" class="table table-hover table-striped table-responsive">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="w-75">Ítem</th>
                              <th class="w-5">Quantidade</th>
                              <th class="w-5">Valor unitário</th>
                              <th class="w-5">Valor total</th>
                              <th class="">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                             @if (isset($dadosProject))
                                @foreach($dadosProject->getOrcamentos as $orcamento)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$orcamento->desc_item}}</td>
                                    <td>{{$orcamento->quantidade}}</td>
                                    <td>R${{number_format($orcamento->valor_unitario, 2, ',', '.')}}</td>
                                    <td>R${{number_format($orcamento->valor_total, 2, ',', '.')}}</td>
                                    <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-orcamento" )'></i></td>
                                  </tr>
                                @endforeach
                              @endif
                          </tbody>
                        </table>
                        {!! Form::hidden('table-orcamento', null, ['id' => 'tableorcamento']) !!}
                        <hr>
                        <p class="lead text-right">Total geral: <b class="text-danger">R$</b><b id="pTotalGeral" class="text-danger">{{isset($dadosProject) ? number_format($dadosProject->total_geral, 2, ',', '.') : 0.0}}</b> </p>
                      </div>
                    </div>
                    <hr>
                  </div>
                  </div>
                <div class="tab-pane" id="tab5">
                    <br id="content-recurso">
                    <h3 class="text-center">Recursos (Infra-Estrutura envolvida)</h3>
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Espaço/ Recurso</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputRecurso" placeholder="Digite o espaço/recurso"> </div>
                    </div>
                    <div class="form-group row"> <label class="col-sm-2 col-form-label text-left">Observação</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputObservacaoRecurso" placeholder="Digite as observações"> </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">
                            <a href="#content-recurso" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputRecurso, inputObservacaoRecurso], 'table-recurso')">Adicionar</a>
                        </div>
                      </div>
                    <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                      <div class="col-form-label col-md-2 col-lg-2"></div>
                      <div class="col-form-label col-12 col-sm-12 col-md-10 col-lg-10 ml-0">
                        <table id="table-recurso" class="table table-hover table-striped table-responsive">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="w-50">Espaço/Recurso</th>
                              <th class="w-50">Observação</th>
                              <th class="">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                             @if (isset($dadosProject))
                                @foreach($dadosProject->getRecursos as $recurso)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$recurso->espaco}}</td>
                                    <td>{{$recurso->observacao}}</td>
                                    <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-recurso" )'></i></td>
                                  </tr>
                                @endforeach
                              @endif
                          </tbody>
                        </table>
                        {!! Form::hidden('table-recurso', null, ['id' => 'tablerecurso']) !!}
                      </div>
                    </div>
                    <hr>
                    <br>
                    <br>
                    <br id="content-retorno">
                    <h2 class="text-center">Retorno da proposta para a comunidade acadêmica</h2>
                    <div class="form-group row">
                      <div class="form-check col-12 text-left">
                        <div class="col-md-2">
                          {!! Form::checkbox('inlineCheckOrcamento', null, (isset($dadosProject) && $dadosProject->retorno_proposta == 'false' ) ? 1 : 0, ['class' => 'form-check-input ml-1', 'onClick' => 'check(this.id)', 'id' => 'defaultCheckRetorno']) !!}
                        </div>
                        <div class="col-md-4"> <label class="form-check-label" for="defaultCheckRetorno">
                          Não se aplica
                        </label> </div>
                      </div>
                    </div>
                    <hr>
                    <div id="hide-retorno">
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-left">Retorno da proposta</label>
                      <div class="col-sm-10"> 
                        {!! Form::textarea('retorno_proposta', null, ['class' => 'form-control', 'placeholder' => 'Descrever os beneficios que este trabalho trará para a comunidade acadêmica e/ou conquistense ', 'rows' => '5', 'resize' => 'none', 'id' => 'inputProposta']) !!}
                      </div>
                    </div>
                  </div>
                  </div>
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
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/datepicker/css/daterangepicker.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap-wizard/css/prettify.css')}}">
    @endpush
    <!-- Scripts -->
    @push( 'scripts-footer' )
        <!--script src="{{ asset('assets/form-slide/js/form-slide.js') }}"-->
        </script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
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
                onTabClick: function (tab, navigation, index) { 
                  tab.removeClass('active');
                },             
                onNext: function (tab, navigation, index) {
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
          $(function(){
            $('#daterange').daterangepicker({
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
            "startDate": '{{isset($dadosProject->periodo_realizacao) ? $dadosProject->periodo_realizacao : date("d/m/Y")}}' ,
            "endDate": '{{isset($dadosProject->periodo_realizacao) ? explode(' à ',$dadosProject->periodo_realizacao)[1] : ""}}' || new Date(new Date().setDate(new Date().getDate() + 5)),
        }, function(start, end, label) {
        });

        $('#inputValorUnitario').mask('#.##0,00', {reverse: true});
        $('#inputTelefoneEquipe').mask('(00) o0000-0000', {
          translation: {
            'o': {pattern: /[0-9]/, optional: true}
          }});
        });
        </script>

        <script>
          /* ****** VERIFICA TODOS OS CHECKBOXS *********
          ** Caso esteja carregando os dados ele tem que verificar 
          **  se existe algum que esteja vazio e esconde-lo 
          */
            window.onload = check('defaultCheckCriterios');
            window.onload = check('defaultCheckConteudo');
            window.onload = check('defaultCheckAvaliacao');
            window.onload = check('defaultCheckParceria');
            window.onload = check('defaultCheckOrcamento');
            window.onload = check('defaultCheckRetorno');
          
            /* ******* VERIFICA S EO CHECKBOX FOI CLICADO ******** 
          ** Caso foi clicado ele irá esconder e setar o valor do input como falso
          ** caso não ele preenche o input com um campo string vazio e 
          **  exibe a tabela permitindo assim preencher novos dados 
          */  
          function check(idCheck) {
            var checkBox = document.getElementById(idCheck);
            if( checkBox.checked ) {
              switch(idCheck) {
                case "defaultCheckCriterios":
                  document.getElementById('hide-criterio').style.display = 'none';
                  document.getElementById('tablecriterio').value = "false"; 
                  document.getElementById('tabledocumento').value = "false"; 
                break;
                case "defaultCheckConteudo":
                  document.getElementById('hide-referencia').style.display = 'none';
                  document.getElementById('tablereferencia').value = "false";
                break;
                case "defaultCheckAvaliacao":
                  document.getElementById('hide-avaliacao').style.display = 'none';
                  document.getElementById('inputAvaliacao').value = "false";
                break;
                case "defaultCheckParceria":
                  document.getElementById('hide-parceria').style.display = 'none';
                  document.getElementById('tableparceria').value = "false";
                break;
                case "defaultCheckOrcamento":
                  document.getElementById('hide-orcamento').style.display = 'none';
                  document.getElementById('tableorcamento').value = "false";
                break;
                case "defaultCheckRetorno":
                  document.getElementById('hide-retorno').style.display = 'none';
                  document.getElementById('inputProposta').value = "false";
                break;
              }
            } else {
              switch(idCheck) {
                case "defaultCheckCriterios":
                  document.getElementById('hide-criterio').style.display= 'block';
                  if (document.getElementById('tablecriterio').value == "false") {
                    document.getElementById('tablecriterio').value = ""; 
                    removerTudo('table-criterio');
                  }
                  if (document.getElementById('tabledocumento').value == "false") {
                    document.getElementById('tabledocumento').value = ""; 
                    removerTudo('table-documento');
                  }
                break;
                case "defaultCheckConteudo":
                  document.getElementById('hide-referencia').style.display = 'block';
                  if (document.getElementById('tablereferencia').value == "false") {
                    document.getElementById('tablereferencia').value = "";
                    removerTudo('table-referencia');
                  }
                break;
                case "defaultCheckAvaliacao":
                  if (document.getElementById('inputAvaliacao').value == 'false') {
                    document.getElementById('inputAvaliacao').value = "";
                  }
                  document.getElementById('hide-avaliacao').style.display = 'block';
                break;
                case "defaultCheckParceria":
                  document.getElementById('hide-parceria').style.display = 'block';
                  if (document.getElementById('tableparceria').value == "false") {
                    document.getElementById('tableparceria').value = "";
                    removerTudo('table-parceria');
                  }
                break;
                case "defaultCheckOrcamento":
                  document.getElementById('hide-orcamento').style.display = 'block';
                  if (document.getElementById('tableorcamento').value == "false") {
                    document.getElementById('tableorcamento').value = "";
                    removerTudo('table-orcamento');
                  }
                break;
                case "defaultCheckRetorno":
                  document.getElementById('hide-retorno').style.display = 'block';
                  if (document.getElementById('inputProposta').value == 'false') {
                    document.getElementById('inputProposta').value = "";
                  }
                break;
              }
            }
          }
        </script>


        <script>
          totalGeral = {{isset($dadosProject->total_geral) ? $dadosProject->total_geral : 0.0 }};

          /* ******* PREENCHER A TABELA COM OS DADOS DOS INPUTS ******* 
          ** Um array com os dados de cada input é enviado e o id da tabela que deve ser preenchida
          **  irá criar uma nova linha e preencher com os dados fornecidos no array
          */
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
                  
                  // Se a coluuna for a primeira adicionar o número da linha
                  if ( j == 0 ) {
                    newCell.innerHTML = numOfRows;
                  } 
                  // caso não ele irá pegar os dados do array e adicionar em sua coluna especifica
                  else if (j > 0  && j < (numOfCols-1) && j <= array.length) {
                    // dadosTabela será adicionado a um input do tipo hidden com separador | que será utilizado
                    //  posteriormente no metodo de salvar no BD
                    dadosTabela += array[j-1].value + '|'; 
                    //se o campo envolver um valor de formatação de valor de moeda adicionar a vírgula segundo o padrão pt-BR
                    //caso não somente adicione o campo de acordo como no seu determinado input
                    if (array[j-1].id == 'inputValorUnitario')
                      newCell.innerHTML = 'R$' + array[j-1].value.toLocaleString('pt-BR');
                    else
                      newCell.innerHTML = array[j-1].value;  
                  } 
                  //caso seja a ultima coluna adicionar o link de remoção com icone da lixeira
                  else if (j == (numOfCols-1)) {
                    newCell.innerHTML = "<i class='fa fa-trash text-danger' onClick='remover(" + numOfRows + ", \"" + idTabela + "\")'></i>";
                  } 
                  // Caso seja a tabela de orçamento antes de ser a ultima coluna deve fazer a operação da quantidade * valor
                  //  e do total geral de todos os valores resultantes
                  //  e então exibir nos campos corretos
                  else if((j == (numOfCols-2) && idTabela == 'table-orcamento')){
                    qtd = parseFloat(array[1].value);
                    valorProduto = parseFloat((array[2].value.split('.').join('')).split(',').join('.')).toFixed(2);
                    total = qtd * valorProduto;
                    totalGeral += total;
                    newCell.innerHTML = 'R$' + total.toLocaleString('pt-BR');
                  }
                  // Insere um conteúdo na coluna
                  
              }
              //Adicionando so dados preencidos na tabel com o separador | no input do tipo hidden
              var inputTable = document.getElementById(idTabela.replace("-", "")).value += dadosTabela; 
              
              if (inputTable.value == 'false')
                inputTable.value = '';
              
                inputTable.value += dadosTabela;
              
              //exibi a soma para verificar um total
              if(idTabela == 'table-orcamento'){
                document.getElementById('pTotalGeral').innerText = totalGeral.toLocaleString('pt-BR');
              }
              this.limparInput(array)

            }

            /* ******* REMOVER O ESPECIFICO DADO DA TABELA *******
            ** Irá remover a linha clicada (na lixeira) de determinada tabela
            **  em suma ele irá remover e realimentar o input hidden com os novos valores da tabela
            */
            function remover(row, tableID){              
              dadosTabela = '';
              var rows = document.getElementById(tableID).getElementsByTagName("tr");            
                for (var j = 1; j < rows.length; j++) {
                  var cells = rows[j].getElementsByTagName("td");
                  for (var i = 0; i < cells.length; i++) {
                    if (cells[i].innerHTML == row ) {
                      if (tableID == "table-orcamento") {
                        valorTotalItem = parseFloat(((cells[4].innerHTML.replace('R$', '')).split('.').join('')).split(',').join('.')).toFixed(2);
                        totalGeral -= valorTotalItem;
                        document.getElementById('pTotalGeral').innerText = totalGeral.toLocaleString('pt-BR');
                      }
                      document.getElementById(tableID).deleteRow(j);
                      //manter o mesmo número de sequencia quando for removido
                      row = - 1;
                      j --;
                      i = cells.length;
                    } else {
                      if(i == 0 && row == -1) {
                        cells[i].innerHTML = j;
                      }
                      if (i > 0 && i < (cells.length - 1) && tableID != "table-orcamento"){
                        dadosTabela += cells[i].innerHTML + '|'; 
                      } else if (i == (cells.length - 1)) {
                        cells[i].innerHTML = "<i class='fa fa-trash text-danger' onClick='remover(" + j + ", \"" + tableID + "\")'></i>";
                      } else if(i > 0 && i < (cells.length - 2) && tableID == "table-orcamento"){
                        dadosTabela += cells[i].innerHTML.replace('R$', '') + '|';
                      }
                    }
                  }
                }
              document.getElementById(tableID.replace("-", "")).value = dadosTabela; 
            }

            /* ****** LIMPAR O INPUT SEMPRE QUE SOLICITADO ****** */
            function limparInput(array) {
              for (var i = 0; i < array.length; i++) 
                document.getElementById(array[i].id).value = "";
            }

            /* ****** REMOVER TODOS AS LINHAS DA TABELA ********* */
            function removerTudo(tableID){  
              var rows = document.getElementById(tableID).getElementsByTagName("tr");            
                for (var j = 1; j < rows.length; j++) {
                      document.getElementById(tableID).deleteRow(j);
                } 
            }

        </script>
    @endpush
    