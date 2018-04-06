@extends('layouts.app')

@section('content')
<div class="py-1 text-right">
    <div class="container">
      <div class="row text-left"> </div>
      <div class="row">
        <div class="col-md-7 col-lg-8 col-xl-9"></div>        
        @include('includes.alert.alerts')
      </div>
    </div>
  </div>
<div class="py-3 text-center">
  <div class="container text-center">
    <div class="row text-center"> </div>
    <div class="row">
      <div class="col-md-12"> <i class="far fa-4x fa-file"></i>
        <h1 class="text-center display-3">Corrigir Projeto - {{$dadosProject->titulo_projeto}}</h1>
      </div>
    </div>
  </div>
</div>
<div>
<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form class="" method="post" action="{{route('update-correcao-projeto')}}" id="form-projeto">
          {!! csrf_field()!!}
          <div id="rootwizard">
              <div class="col-md-12 text-center">
                <div class="navbar-inner col-md-12">
                  <div class="containe">
                    <ul class="list-inline">
                      <div class="col-md-12 text-center">
                        <li class="col-2 list-inline-item"><a class=" p-1 btn-block btn btn-primary" href="#tab1" data-toggle="tab" title="Dados do projeto"><i class="fas fa-address-book"></i></a></li>
                        <li class="col-2 list-inline-item"><a class=" p-1 btn-block btn btn-primary" href="#tab2" data-toggle="tab" title="Dados da Equipe organizadora"><i class="fas fa-users"></i></a></li>
                        <li class="col-2 list-inline-item"><a class=" p-1 btn-block btn btn-primary" href="#tab3" data-toggle="tab" title="Conteúdos/Referências & Avaliação"><i class="fas fa-file"></i></a></li>
                        <li class="col-2 list-inline-item"><a class=" p-1 btn-block btn btn-primary" href="#tab4" data-toggle="tab" title="Parcerias & Orçametos"><i class="fas fa-handshake"></i></a></li>
                        <li class="col-2 list-inline-item"><a class=" p-1 btn-block btn btn-primary" href="#tab5" data-toggle="tab" title="Recursos & Retorno da proposta"><i class="fas fa-book"></i></a></li>
                      </div>  
                    </ul>
                  </div>
                </div>
              </div>
                <div id="bar" class="progress my-3">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div>
              <div class="tab-content">
                  <div class="tab-pane" id="tab1">
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Título do Projeto</label>
                        <div class="col-sm-10">
                          <input type="hidden" name="id" value="{{$dadosProject->id}}">
                          <input type="text" class="form-control" value="{{$dadosProject->titulo_projeto}}" id="inputTitulo" placeholder="Digite o título do projeto" name="inputTitulo"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Colegiado de origem</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->colegiado_origem}}" id="inputColegiado" placeholder="Digite o colegiado de origem" name="inputColegiado"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Outros colegiados</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->outros_colegiados}}"  id="inputOutrosColegiados" placeholder="Digite outros colegiados" name="inputOutrosColegiados"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Autores do projeto</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->autores}}"  id="inputAutores" placeholder="Digite os autores do projeto (NÃO PODE SER ALUNO)" aria-describedby="autorHelpBlock" name="inputAutores">
                          <div> 
                            <small class="text-danger" id="inputAutores">* Não pode ser aluno</small> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">E-mails</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->emails_responsaveis}}" id="inputEmailsAutores" placeholder="Digite os e-mails dos autores. Ex: email1@gmail.com, email2@gmail.com" name="inputEmailsAutores">
                          <div> 
                            <small class="text-danger" id="inputEmailsAutores">* Separados por vírgula</small> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Data de aprovação do colegiado ou direção do campus</label>
                        <div class="col-sm-10">
                          <input type="text" value="{{$dadosProject->data_aprovacao_colegiado}}"  name="inputdataAprovacaoColegiado" class="form-control" id="inputdataAprovacaoColegiado" placeholder="Data de Aprovação" disabled=""> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Data de entrada no NAAC</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->data_entrada_naac}}" id="inputDataEntradaNAAC" placeholder="Data de entrada no NAAC" disabled="" name="inputDataEntradaNAAC"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Número de registro NAAC</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->numero_registro_naac}}" id="inputNumeroRegistro" placeholder="Número de registro do NAAC" name="inputNumeroRegistro" disabled=""> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Data Aprovação NAAC</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->data_aprovacao_naac}}" id="inputDataAprovacaoNAAC" placeholder="Data de aprovação no NAAC" disabled="" name="inputDataAprovacaoNAAC"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Coordenador do projeto</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->nome_coordenador}}" id="inputCoordenador" placeholder="Digite o coordenador do projeto" name="inputCoordenador"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Público Alvo</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->publico_alvo}}" id="inputPublicoAlvo" placeholder="Digite o público alvo" name="inputPublicoAlvo"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">de Cunho Social</label>
                        <div class=" col-12 col-sm-4 col-md-3 col-lg-2 ml-3 form-control">
                          <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input ml-1" type="radio" checked name="inlineRadioCunho" id="inlineRadio1" value="Sim"> 
                            <label class="form-check-label " for="inlineRadio1"> Sim </label> 
                          </div>
                          <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input ml-1" type="radio" name="inlineRadioCunho" id="inlineRadio2" value="Não"> 
                            <label class="form-check-label" for="inlineRadio2"> Não </label> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Período da realização</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->periodo_realizacao}}" id="daterange" placeholder="Escolha o período de realização" name="dateRangePeriodo"> 
                        </div>
                      </div>
                      <div class="form-group col-6 row"> 
                        <label class="col-sm-4 col-form-label text-right">Carga horária do evento</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control" placeholder="Digite a carga horária do evento" value="{{$dadosProject->carga_horaria}}" id="inputCH" name="inputCH"> 
                        </div>
                      </div>
                      <div class="form-group col-6 row"> 
                        <label class="col-sm-4 col-form-label text-right">Número de vagas</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control" value="{{$dadosProject->numero_vagas}}" id="inputVagas" placeholder="Digite o número de vagas" name="inputVagas"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Dias e horarios da realização do evento</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputDiasHoras" placeholder="Digite os dias e horas de relização do evento" name="inputDiasHoras" rows="5">{{$dadosProject->dias_horarios_evento}}</textarea>
                          <div> 
                            <span class="text-danger" id="inputAutores">* Separados por vírgula. <b>Ex: Segunda 20:00 - 21:00, Terça 16:00 - 22:00</b></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Apresentação/ Justificativa</label>
                        <div class="col-sm-10"> 
                          <textarea class="form-control" id="inputJustificatva" placeholder="Digite a Apresentação/Justificativa" name="inputJustificatva" rows="5">{{$dadosProject->justificativa}}</textarea> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Objetivo geral</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->objetivo_geral}}" id="inputObjetivoGeral" placeholder="Digite o Objetivo geral" name="inputObjetivoGeral"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Objetivos específicos</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$dadosProject->objetivos_especificos}}" id="inputObjetivosEspecificos" placeholder="Digite os Objetivos específicos" name="inputObjetivosEspecificos"> 
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                      <br id="content-equipe">
                      <h2 class="text-center">Equipe Executora/Organizadora</h2>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Nome</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputNomeEquipe" placeholder="Digite o nome"> 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Email</label>
                        <div class="col-sm-5">
                          <input type="email" class="form-control" id="inputEmailEquipe" placeholder="Digite o email"> 
                        </div>
                        <div class="col-sm-5">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label text-right">Telefone</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="inputTelefoneEquipe" placeholder="Digite o telefone" data-mask="(99) 09999-9999"> 
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">
                          <a href="#content-equipe" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputNomeEquipe, inputEmailEquipe, inputTelefoneEquipe], 'table-equipe')">Adicionar</a>
                        </div>
                      </div>
                      <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                        <div class="col-sm-2 col-form-label col-md-2 col-2 col-lg-2">
                        </div>
                        <div class="ml-0 col-form-label col-10 col-sm-10 col-md-10 col-lg-10">
                          <table id="table-equipe" class="table table-hover table-striped">
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
                            @foreach($dadosProject->getEquipe as $equipe)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$equipe->nome}}</td>
                                <td>{{$equipe->email}}</td>
                                <td>{{$equipe->telefone}}</td>
                                <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-equipe" )'></i></td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <input type="hidden" name="table-equipe" id="tableequipe" value="{{$valueEquipe}}">
                        </div>
                      </div>
                      <br id="content-criterio">
                      <h3 class="text-center">Critérios para seleção</h3>
                      <div class="form-group row">
                        <div class="form-check col-12">
                          <div class="col-md-2">
                            @if ($valueCriterios == "")
                              <input class="form-check-input ml-1" type="checkbox" value="" checked id="defaultCheckCriterio" onClick="check(this.id)">
                            @else
                              <input class="form-check-input ml-1" type="checkbox" value="" id="defaultCheckCriterio" onClick="check(this.id)">
                            @endif   
                          </div>                         
                          <div class="col-md-4"> 
                            <label class="form-check-label" for="defaultCheckCriterio">Não se aplica</label> 
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div id="hide-criterio">
                      <div  class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Critério</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputCriterioEquipe" placeholder="Digite o critério" > 
                        </div>
                        <div class="col-sm-2">
                          <a href="#content-criterio" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputCriterioEquipe], 'table-criterio')">Adicionar</a>
                        </div>
                      </div>
                      <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                        <div class="col-sm-2 col-form-label col-md-2 col-2 col-lg-2">
                        </div>
                        <div class="ml-0 col-form-label col-10 col-sm-10 col-md-10 col-lg-10">
                          <table id="table-criterio" class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="w-100">Critério de seleção</th>
                                <th class="">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($dadosProject->getCriterios as $criterio)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$criterio->desc_criterio}}</td>
                                <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-criterio" )'></i></td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <input type="hidden" name="table-criterio" id="tablecriterio" value="{{$valueCriterios}}">
                        </div>
                      </div>
                      <br id="content-documento">
                      <h3 class="text-center">Documentação necessária</h3>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Documento</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputDocumento" placeholder="Digite o documento" > 
                        </div>
                        <div class="col-sm-2">
                          <a href="#content-documento" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputDocumento], 'table-documento')">Adicionar</a>
                        </div>
                      </div>
                      <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                        <div class="col-sm-2 col-form-label col-md-2 col-2 col-lg-2">
                        </div>
                        <div class="ml-0 col-form-label col-10 col-sm-10 col-md-10 col-lg-10">
                          <table id="table-documento" class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="w-100">Documento</th>
                                <th class="">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($dadosProject->getDocumento as $documento)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$documento->desc_documento}}</td>
                                <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-documento" )'></i></td>
                              </tr>
                            @endforeach 
                            </tbody>
                          </table>
                          <input type="hidden" name="table-documento" id="tabledocumento" value="{{$valueDocumentos}}">
                        </div>
                      </div>

                    </div>
                      <br id="content-atividade">
                      <h3 class="text-center">Atividades previstas</h3>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Atividade</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputAtividade" placeholder="Digite a atividade" > 
                        </div>
                      </div>
                       <div class="form-group row"> <label class="col-sm-2 col-form-label text-right">Título</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputTituloAtividade" placeholder="Digite o título da atividade" > 
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Observação</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputObservacao" placeholder="Digite a observação" > 
                        </div>
                        <div class="col-sm-2">
                          <a href="#content-atividade" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputAtividade, inputTituloAtividade, inputObservacao], 'table-atividade')">Adicionar</a>
                        </div>
                      </div>
                      <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                        <div class="col-sm-2 col-form-label col-md-2 col-2 col-lg-2">
                        </div>
                        <div class="ml-0 col-form-label col-10 col-sm-10 col-md-10 col-lg-10">
                          <table id="table-atividade" class="table table-hover table-striped">
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
                            @foreach($dadosProject->getAtividades as $atividade)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$atividade->desc_atividades}}</td>
                                <td>{{$atividade->titulo_atividade}}</td>
                                <td>{{$atividade->obs_atividade}}</td>
                                <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-atividade" )'></i></td>
                              </tr>
                            @endforeach 
                            </tbody>
                          </table>
                          <input type="hidden" name="table-atividade" id="tableatividade" value="{{$valueAtividades}}">
                        </div>
                      </div>
                      <hr>
                  </div>
                <div class="tab-pane" id="tab3">
                    <br id="content-referencia">
                    <h2 class="text-center">Conteúdos/Referências</h2>
                    <div class="form-group row">
                      <div class="form-check col-12">
                        <div class="col-md-2">
                          @if ($valueConteudos == "")
                            <input class="form-check-input ml-1" type="checkbox" checked value="" id="defaultCheckConteudo" onClick="check(this.id)">
                          @else
                            <input class="form-check-input ml-1" type="checkbox" value="" id="defaultCheckConteudo" onClick="check(this.id)">
                          @endif
                        </div>
                        <div class="col-md-4"> 
                          <label class="form-check-label" for="defaultCheckConteudo">Não se aplica</label> 
                        </div>
                      </div>
                    <hr>
                    <div id="hide-referencia">
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Conteúdo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputConteudo" placeholder="Digite o conteúdo"> 
                      </div>
                    </div>
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Principais referências</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputReferencia" placeholder="Digite a principal referência" > 
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-2 col-form-label">
                      </div>
                      <div class="col-sm-10">
                        <a href="#content-referencia" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputConteudo, inputReferencia], 'table-referencia')">Adicionar</a>
                      </div>
                    </div>
                    <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                      <div class="col-sm-2 col-form-label col-md-2 col-2 col-lg-2">
                      </div>
                      <div class="ml-0 col-form-label col-10 col-sm-10 col-md-10 col-lg-10">
                        <table id="table-referencia" class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="w-50">Conteúdo</th>
                              <th class="w-50">Referência</th>
                              <th class="">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($dadosProject->getConteudos as $conteudo)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$conteudo->desc_conteudo}}</td>
                              <td>{{$conteudo->referencia}}</td>
                              <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-referencia" )'></i></td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                        <input type="hidden" name="table-referencia" id="tablereferencia" value="{{$valueConteudos}}">
                      </div>
                    </div>
                    </div>
                    <hr>
                  </div>
                    <br>
                    <br>
                    <br id="content-avaliacao">
                    <h2 class="text-center">Avaliação</h2>
                    <div class="form-group row">
                      <div class="form-check col-12">
                        <div class="col-md-2">
                          @if ($dadosProject->avaliacao == "false")
                            <input class="form-check-input ml-1" type="checkbox" checked value="" id="defaultCheckAvaliacao" onClick="check(this.id)">
                          @else
                            <input class="form-check-input ml-1" type="checkbox" value="" id="defaultCheckAvaliacao" onClick="check(this.id)">
                          @endif
                        </div>
                        <div class="col-md-4"> 
                          <label class="form-check-label" for="defaultCheckAvaliacao">Não se aplica</label> 
                        </div>
                      </div>
                    <hr>
                    <div class="col-sm-12" id="hide-avaliacao">
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Avaliação</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAvaliacao" placeholder="Digite a avaliação" name="inputAvaliacao" value="{{$dadosProject->avaliacao}}"> 
                      </div>
                    </div>
                  </div>
                  <hr>
                  </div>
                </div>
                <div class="tab-pane" id="tab4">
                    <br id="content-parceria">
                    <h2 class="text-center">Quadro de parcerias</h2>
                    <div class="form-group row">
                      <div class="form-check col-12">
                        <div class="col-md-2">
                          @if ($valueParcerias == "")
                            <input class="form-check-input ml-1" type="checkbox" checked value="" id="defaultCheckParceria" onClick="check(this.id)"> 
                          @else
                            <input class="form-check-input ml-1" type="checkbox" value="" id="defaultCheckParceria" onClick="check(this.id)"> 
                          @endif 
                        </div>                         
                        <div class="col-md-4"> 
                          <label class="form-check-label" for="defaultCheckParceria">Não se aplica</label> 
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div id="hide-parceria">
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Parceria/ Instituição</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputParceria" placeholder="Digite a parceria" > 
                      </div>
                    </div>
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Representante</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputRepresentante" placeholder="Digite o representante" > 
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group row"> 
                          <label class="col-sm-3 col-form-label text-right">Contato</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputContatoRepresentante" placeholder="Digite o contato"> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-2 col-form-label">
                      </div>
                      <div class="col-sm-10">
                        <a href="#content-parceria" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputParceria, inputRepresentante, inputContatoRepresentante], 'table-parceria')">Adicionar</a>
                      </div>
                    </div>
                    <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                      <div class="col-sm-2 col-form-label col-md-2 col-2 col-lg-2">
                      </div>
                      <div class="ml-0 col-form-label col-10 col-sm-10 col-md-10 col-lg-10">
                        <table id="table-parceria" class="table table-hover table-striped">
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
                          @foreach($dadosProject->getParcerias as $parceria)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$parceria->desc_parceria}}</td>
                              <td>{{$parceria->representante}}</td>
                              <td>{{$parceria->contato}}</td>
                              <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-parceria" )'></i></td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                        <input type="hidden" name="table-parceria" id="tableparceria" value="{{$valueParcerias}}">
                      </div>
                    </div>
                    <hr>
                  </div>
                    <br>
                    <br>
                    <br id="content-orcamento">
                    <h2 class="text-center">Orçamento (Custos Envolvidos)</h2>
                    <div class="form-group row">
                      <div class="form-check col-12">
                        <div class="col-md-2">
                          @if ($valueOrcamentos == "")
                            <input class="form-check-input ml-1" type="checkbox" checked value="" id="defaultCheckOrcamento" onClick="check(this.id)">
                          @else
                           <input class="form-check-input ml-1" type="checkbox" value="" id="defaultCheckOrcamento" onClick="check(this.id)">
                          @endif
                        </div>
                        <div class="col-md-4"> 
                          <label class="form-check-label" for="defaultCheckOrcamento">Não se aplica</label> 
                        </div>
                      </div>
                    <hr>
                    <div id="hide-orcamento">
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Ítem a ser orçado</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputItemOrcado" placeholder="Digite o ítem a ser orçado"> 
                      </div>
                    </div>
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Quantidade</label>
                      <div class="col-sm-4">
                        <input type="number" class="form-control" id="inputQuantidade" placeholder="Digite a quantidade" data-mask="9999"> 
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group row"> 
                          <label class="col-sm-3 col-form-label text-right">Valor unitário</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputValorUnitario" placeholder="Digite o valor unitário" data-mask="##.##0,00" > 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-2 col-form-label">
                      </div>
                      <div class="col-sm-10">
                        <a href="#content-orcamento" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputItemOrcado, inputQuantidade, inputValorUnitario], 'table-orcamento')">Adicionar</a>
                      </div>
                    </div>
                    <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                      <div class="col-sm-2 col-form-label col-md-2 col-2 col-lg-2">
                      </div>
                      <div class="ml-0 col-form-label col-10 col-sm-10 col-md-10 col-lg-10">
                        <table id="table-orcamento" class="table table-hover table-striped">
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
                          </tbody>
                        </table>
                        <input type="hidden" name="table-orcamento" id="tableorcamento" value="{{$valueOrcamentos}}">
                        <hr>
                        <p class="lead text-right">Total geral: <b class="text-danger">R$</b> <b id="pTotalGeral" class="text-danger">{{number_format($total_geral, 2, ',', '.')}}</b></p>
                      </div>
                    </div>
                    <hr>
                  </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab5">
                    <br id="content-recurso">
                    <h3 class="text-center">Recursos (Infra-Estrutura envolvida)</h3>
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Espaço/Recurso</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputRecurso" placeholder="Digite o espaço/recurso"> 
                      </div>
                    </div>
                    <div class="form-group row"> 
                      <label class="col-sm-2 col-form-label text-right">Observação</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputObservacaoRecurso" placeholder="Digite as observações"> 
                      </div>
                      <div class="col-sm-2">
                        <a href="#content-recurso" class="mr-12 btn btn-block btn-success" onClick="preencheTabela([inputRecurso, inputObservacaoRecurso], 'table-recurso')">Adicionar</a>
                      </div>
                    </div>
                    <div class="form-group row col-sm-12 col-md-12 col-12 col-lg-12 col-xl-12">
                      <div class="col-sm-2 col-form-label col-md-2 col-2 col-lg-2">
                      </div>
                      <div class="ml-0 col-form-label col-10 col-sm-10 col-md-10 col-lg-10">
                        <table id="table-recurso" class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="w-50">Espaço/Recurso</th>
                              <th class="w-50">Observação</th>
                              <th class="">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($dadosProject->getRecursos as $recurso)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$recurso->espaco}}</td>
                                <td>{{$recurso->observacao}}</td>
                                <td><i class='fa fa-trash text-danger' onClick='remover({{$loop->iteration}}, "table-recurso" )'></i></td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <input type="hidden" name="table-recurso" id="tablerecurso" value="{{$valueRecursos}}">
                      </div>
                    </div>
                    <hr>
                    <br>
                    <br>
                    <br id="content-retorno">
                    <h2 class="text-center">Retorno da proposta para a comunidade acadêmica</h2>
                    <div class="form-group row">
                      <div class="form-check col-12">
                        <div class="col-md-2">
                          @if ($dadosProject->retorno_proposta == "false")
                            <input class="form-check-input ml-1" type="checkbox" checked value="" id="defaultCheckRetorno" onClick="check(this.id)">
                          @else
                            <input class="form-check-input ml-1" type="checkbox" value="" id="defaultCheckRetorno" onClick="check(this.id)">
                          @endif                          
                        </div>
                        <div class="col-md-4"> 
                          <label class="form-check-label" for="defaultCheckRetorno">Não se aplica</label> 
                        </div>
                      </div>
                    <hr>
                    <div class="col-sm-12" id="hide-retorno">
                      <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label text-right">Retorno da proposta</label>
                        <div class="col-sm-10"> 
                          <textarea class="form-control" id="inputProposta" placeholder="Descrever os beneficios que este trabalho trará para a comunidade acadêmica e/ou conquistense " name="inputProposta" rows="5"> {{$dadosProject->retorno_proposta}} </textarea> 
                        </div>
                    </div>
                    </div>
                  </div>
                  </div>
                </div>
                <ul class="pager wizard list-inline">
                  <div class="row">
                  <div class="text-left col-md-6">
                      <li class="list-inline-item previous"><a class="btn btn-danger" href="#rootwizard"><i class="fas fa-angle-left"></i> Anterior</a></li>
                      <li class="list-inline-item next"><a class="btn btn-success" href="#rootwizard">Próximo <i class="fas fa-angle-right"></i></a></li>
                  </div>
                  <div class="text-right col-md-6">
                      <a href="{{url('/home')}}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
                      <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Enviar Correção</button>
                  </div>
                  </div>
                </ul>
              </div>
        </form>
      </div>  
      </div>
    </div>
  </div>
</div>
@endsection

    @push('styles')
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/datepicker/css/daterangepicker.css')}}">
      <!--link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap-wizard/css/prettify.css')}}"-->
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
              $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
              var $total = navigation.find('li').length;
              var $current = index+1;
              var $percent = ($current/$total) * 100;
              $('#rootwizard .progress-bar').css({width:$percent+'%'});
            }});
            window.prettyPrint && prettyPrint()
          });
          $(function(){
            $('#daterange').daterangepicker({
            "autoApply": true,
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
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
            "startDate": Date.now(),
            "endDate": new Date(new Date().setDate(new Date().getDate() + 5)),
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
          window.onload = check('defaultCheckCriterio');
          window.onload = check('defaultCheckConteudo');
          window.onload = check('defaultCheckAvaliacao');
          window.onload = check('defaultCheckParceria');
          window.onload = check('defaultCheckOrcamento');
          window.onload = check('defaultCheckRetorno');
          function check(idCheck) {
            var checkBox = document.getElementById(idCheck);
            if( checkBox.checked ) {
              switch(idCheck) {
                case "defaultCheckCriterio":
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
                case "defaultCheckCriterio":
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
                  document.getElementById('hide-avaliacao').style.display = 'block';
                  document.getElementById('inputAvaliacao').value = "";
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
                  document.getElementById('inputProposta').value = "";
                break;
              }
            }
          }
        </script>


        <script>
          totalGeral = {{$total_geral}} || 0.0;
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
                    if (array[j-1].id == 'inputValorUnitario')
                      newCell.innerHTML = 'R$' + array[j-1].value.toLocaleString('pt-BR');
                    else  
                      newCell.innerHTML = array[j-1].value;
                  } else if (j == (numOfCols-1)) {
                    newCell.innerHTML = "<i class='fa fa-trash text-danger' onClick='remover(" + numOfRows + ", \"" + idTabela + "\")'></i>";
                  } else if((j == (numOfCols-2) && idTabela == 'table-orcamento')){
                    qtd = parseFloat(array[1].value);
                    stringProduto = array[2].value.split('.').join('');
                    valorProduto = parseFloat(stringProduto.split(',').join('.')).toFixed(2);
                    total = qtd * valorProduto;
                    totalGeral += total;
                    newCell.innerHTML = 'R$' + total.toLocaleString('pt-BR');
                  }
                  // Insere um conteúdo na coluna
                  
              }
              var inputTable = document.getElementById(idTabela.replace("-", ""));
              if (inputTable.value == 'false')
                inputTable.value = '';
              inputTable.value += dadosTabela; 
              if (idTabela == 'table-orcamento') {
                document.getElementById('pTotalGeral').innerText = totalGeral.toLocaleString('pt-BR');;
              }
              this.limparInput(array)

            }

            function remover(row, tableID){              
              dadosTabela = '';
              var rows = document.getElementById(tableID).getElementsByTagName("tr");            
                for (var j = 1; j < rows.length; j++) {
                  var cells = rows[j].getElementsByTagName("td");
                  for (var i = 0; i < cells.length; i++) {
                    if (cells[i].innerHTML == row ) {
                      if (tableID == "table-orcamento") {
                        valorTotalItem = cells[4].innerHTML.replace('R$', '');
                        total = valorTotalItem.split('.').join('');                        
                        totalGeral -= parseFloat(total.split(',').join('.')).toFixed(2);
                        document.getElementById('pTotalGeral').innerText = totalGeral.toLocaleString('pt-BR');
                      }
                      document.getElementById(tableID).deleteRow(j);
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
                        dadosTabela += cells[i].innerHTML + '|';
                      }
                    }
                  }
                }
              document.getElementById(tableID.replace("-", "")).value = dadosTabela; 
            }

            function removerTudo(tableID){  
              var rows = document.getElementById(tableID).getElementsByTagName("tr");            
                for (var j = 1; j < rows.length; j++) {
                      document.getElementById(tableID).deleteRow(j);
                } 
            }

            function limparInput(array) {
              for (var i = 0; i < array.length; i++) 
                document.getElementById(array[i].id).value = "";
            }

        </script>
    @endpush
    