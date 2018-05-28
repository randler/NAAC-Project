<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-beta.1.css" type="text/css"> </head>

<body>
      <div class="row">
        <div class="col-md-2">
          <img class="img-fluid d-block" src="{{base_path()}}/public/assets/img/ftc.jpg" width="130px"> 
        </div>
        <div class="col-md-8">
          <div class="col-md-12 text-center">
            <h4 class="">Formulário NAAC-DOC-002 Versão 1.0</h4>
            <h5 class="">Projetos de Extensão de Curta Duração</h5>
          </div>
        </div>
        <div class="col-md-2 text-right p-3">
          <img class="img-fluid d-block" src="{{base_path()}}/public/assets/img/naac.jpg" width="70px"> 
        </div>
      </div>
    <div class="row">
      <div class="col-md-12 text-left">
        <ul class="list-group">
          <li class="list-group-item"><b>Título do Projeto :</b> {{$dadosProject->titulo_projeto}} </li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Colegiado de Origem :</b> {{$dadosProject->colegiado_origem}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Demais colegiados beneficiados :</b> {{$dadosProject->outros_colegiados}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Autores do Projeto :</b> {{$dadosProject->autores}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Telefones :</b> {{$dadosProject->telefones}} </li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>E-mails :</b> {{$dadosProject->emails_responsaveis}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Data de Aprovação do colegiado ou direção de campus :</b> {{($dadosProject->data_aprovacao_colegiado == null) ? "Não foi corrigido ainda" : $dadosProject->data_aprovacao_colegiado }}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Data Entrada no NAAC :</b> {{$dadosProject->data_entrada_naac}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Número registro NAAC :</b> {{$dadosProject->numero_registro_naac}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Parecer NAAC :</b> {{($dadosProject->parecer_naac == null) ? "Não foi dado um parecer ainda" : $dadosProject->parecer_naac }}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Data da aprovação do NAAC :</b> {{($dadosProject->data_aprovacao_naac == null) ? "Não foi corrigido ainda" : $dadosProject->data_aprovacao_naac}}</li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-left">
        <ul class="list-group">
          <li class="list-group-item"><b>Coordenador do Projeto :</b> {{$dadosProject->nome_coordenador}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Público Alvo :</b> {{$dadosProject->publico_alvo}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>De Cunho Social :</b> {{($dadosProject->cunho_social) ? "Sim" : "Não"}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Período da Realização :</b> {{$dadosProject->periodo_realizacao}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Carga horaria do evento :</b> {{$dadosProject->carga_horaria}} hora(s)</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Nº de vagas para participantes :</b> {{$dadosProject->numero_vagas}}</li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item"><b>Dias e Horários da realização do evento:</b> {{$dadosProject->dias_horarios_evento}}</li>
        </ul>
      </div>
    </div>
  <div class="p-2">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-center">Equipe Executora/Organizadora</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-50">Nome Completo</th>
              <th class="bg-dark text-white w-25">E-mail</th>
              <th class="bg-dark text-white w-25">Telefone</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosProject->getEquipe as $equipe)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$equipe->nome}}</td>
                <td>{{$equipe->email}}</td>
                <td>{{$equipe->telefone}}</td>
              </tr>
            @empty
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr> 
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="p-2">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-center">Critérios para selecão</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-100"><b>Critérios de seleção</b></th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosProject->getCriterios as $criterio)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$criterio->desc_criterio}}</td>
              </tr>
            @empty
              <tr>
                <td>-</td>
                <td>-</td>
              </tr> 
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="p-2">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center">Doumentos Necessários</h3>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th class="bg-dark text-white">#</th>
                  <th class="bg-dark text-white w-100"><b>Documentação necessária</b></th>
                </tr>
              </thead>
              <tbody>
                @forelse($dadosProject->getDocumento as $documento)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$documento->desc_documento}}</td>
                  </tr>
                @empty
                  <tr>
                    <td>-</td>
                    <td>-</td>
                  </tr> 
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
    </div>
  <div class="p-2">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-center">Atividades Previstas no Projeto</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-50">Atividade</th>
              <th class="bg-dark text-white w-25">Título</th>
              <th class="bg-dark text-white w-25">Observações</th>
            </tr>
          </thead>
          <tbody>
              @forelse($dadosProject->getAtividades as $atividade)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$atividade->desc_atividades}}</td>
                <td>{{$atividade->titulo_atividade}}</td>
                <td>{{$atividade->obs_atividade}}</td>
              </tr>
            @empty
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr> 
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="p-2">
    <div class="row">
      <div class="col-md-12">
        <h3 class="">Apresentação/Justificativa</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul class="list-group">
          <li class="list-group-item">{{$dadosProject->justificativa}}</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="p-2">
    <div class="row">
      <div class="col-md-12">
        <h3 class=""><b>Objetivo Geral</b></h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul class="list-group">
          <li class="list-group-item">{{$dadosProject->objetivo_geral}}</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="p-2">
    <div class="row">
      <div class="col-md-12">
        <h3 class="">Objetivos Específicos</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul class="list-group">
          <li class="list-group-item">{{$dadosProject->objetivos_especificos}}</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="p-2">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center">Conteúdos/Referências</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr>
                <th class="bg-dark text-white">#</th>
                <th class="bg-dark text-white w-50">Conteúdos</th>
                <th class="bg-dark text-white w-50">Principais Referências</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dadosProject->getConteudos as $conteudo)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$conteudo->desc_conteudo}}</td>
                <td>{{$conteudo->referencia}}</td>
              </tr>
            @empty
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr> 
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
  </div>
  <div class="p-2">
      <div class="row">
        <div class="col-md-12">
          <h3 class=""><b>Avaliação</b></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="list-group">
            <li class="list-group-item">{{($dadosProject->avaliacao == 'false') ? 'Não há' : $dadosProject->avaliacao }}</li>
          </ul>
        </div>
      </div>
  </div>
  <div class="p-2">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center">Quadro de Parcerias</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr>
                <th class="bg-dark text-white">#</th>
                <th class="bg-dark text-white w-50">Parceria/instituição</th>
                <th class="bg-dark text-white w-25">Representante</th>
                <th class="bg-dark text-white w-25">Contatos</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dadosProject->getParcerias as $parceria)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$parceria->desc_parceria}}</td>
                <td>{{$parceria->representante}}</td>
                <td>{{$parceria->contato}}</td>
              </tr>
            @empty
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr> 
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
  </div>
  <div class="p-2">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center">Orçamento (Custos Envolvidos)</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr>
                <th class="bg-dark text-white">#</th>
                <th class="bg-dark text-white w-50">Ítens a serem orçados</th>
                <th class="bg-dark text-white">Quantidade</th>
                <th class="bg-dark text-white">Valor unitário</th>
                <th class="bg-dark text-white">Valor Total</th>
              </tr>
            </thead>
            <tbody>
                @forelse($dadosProject->getOrcamentos as $orcamento)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$orcamento->desc_item}}</td>
                  <td>{{$orcamento->quantidade}}</td>
                  <td>R${{$orcamento->valor_unitario}}</td>
                  <td>R${{$orcamento->valor_total}}</td>
                </tr>
              @empty
                <tr>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr> 
              @endforelse
            </tbody>
          </table>
          <p class="lead text-right">Total geral: <b class="text-danger">R${{$total_geral}}</b></p>
        </div>
      </div>
  </div>
  <div class="p-2">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center">Recursos (Infra-Estrutura Envolvida)</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr>
                <th class="bg-dark text-white">#</th>
                <th class="bg-dark text-white w-50">Espaço/Recursos Audiovisuais</th>
                <th class="bg-dark text-white w-50">Observações</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dadosProject->getRecursos as $recurso)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$recurso->espaco}}</td>
                  <td>{{$recurso->observacao}}</td>
                </tr>
              @empty
                <tr>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr> 
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
  </div>
  <div class="p-2">
      <div class="row">
        <div class="col-md-12">
          <h3 class=""><b>Retorno da Proposta para a Comunidade Acadêmica</b></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="list-group">
            <li class="list-group-item">{{($dadosProject->retorno_proposta == 'false') ? 'Não há' : $dadosProject->retorno_proposta }}</li>
          </ul>
        </div>
      </div>
  </div>
  <div class="py-5 my-3">
        <div class="row">
          <div class="col-md-12 ">
          </div>
        </div>
        <div class="row">
          <table class="table-sm col-md-12" style="boder: 0;">
            <tbody>
              <tr>
                <td class="w-50">
                  <hr class="border border-dark text-center">
                  <h5 class="text-center">Coordenador do projeto</h5>
                </td>
                <td></td>
                <td class="w-50 text-right">
                  <hr class="border border-dark text-center">
                  <h5 class="text-center">Coordenador do Curso / Setor</h5>
                </td>
              </tr> 
              </tbody>
            </table>
        </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
