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
      <img class="img-fluid d-block" src="{{base_path()}}/public/assets/img/ftc.jpg" width="130px"> </div>
    <div class="col-md-8">
      <div class="col-md-12 text-center">
        <h4 class="">Formulário NAAC-DOC-003 Versão 1.0</h4>
        <h5 class="">Relatório de Projetos de Extensão</h5>
      </div>
    </div>
    <div class="col-md-2 text-right p-3">
      <img class="img-fluid d-block" src="{{base_path()}}/public/assets/img/naac.jpg" width="70px"> </div>
  </div>
  <div class="row">
    <div class="col-md-12 mx-1 text-left">
      <ul class="list-group">
        <li class="list-group-item text-center w-100 mb-3 mt-2 border border-dark">
          <h2 class="p-2"> {{$dadosRelatorio->titulo}} </h2>
        </li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item"><b>Área:&nbsp;</b> {{$dadosRelatorio->area}}</li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item"><b>Subárea:&nbsp;</b> {{$dadosRelatorio->sub_area}}</li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item"><b>Coordenador do projeto:&nbsp;</b> {{$dadosRelatorio->coordenador_projeto}}</li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item"><b>CPF:&nbsp;</b>{{$dadosRelatorio->cpf}}</li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item"><b>Carga horária na realização do evento:&nbsp;</b> {{$dadosRelatorio->carga_horaria_evento}} h</li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item"><b>Período de realização:&nbsp;</b> {{$dadosRelatorio->periodo_realizacao}}</li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item"><b>Período abrangido por este relatório:&nbsp;</b> {{$dadosRelatorio->periodo_abrangido_relatorio}}</li>
      </ul>
      <ul class="list-group"></ul>
      <ul class="list-group"></ul>
      <ul class="list-group"></ul>
    </div>
  </div>
  <div class="px-4 pt-5 text-left">
    <div class="row px-5 my-2">
      <div class="col-md-12 text-left">
        <h4>1. Descrição do projeto originalmente aprovado</h4>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mx-1 text-left">
      <ul class="list-group">
        <li class="list-group-item pb-5 my-2"><b class="">Objetivo geral:&nbsp;</b> {{$dadosRelatorio->objetivo_geral}}</li>
      </ul>
      <ul class="list-group pb-3">
        <li class="list-group-item pb-5 my-2"><b>Objetivos especificos:&nbsp;</b> {{$dadosRelatorio->objetivos_especificos}}</li>
      </ul>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">2. Cronograma de Desenvolvimento do Trabalho</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-75">Descrição da atividade</th>
              <th class="bg-dark text-white w-25">Data</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosRelatorio->getCronograma as $cronograma)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$cronograma->desc_atividade}}</td>
                <td>{{$cronograma->data}}</td>
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
  <div class="px-4 pt-5 text-left">
    <div class="row px-5 my-2">
      <div class="col-md-12 text-left">
        <h4>3. Resultados Obtidos </h4>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-left">
      <ul class="list-group">
        <li class="list-group-item pb-5 my-2"><b class="">Resultados Obtidos:&nbsp;</b> {{$dadosRelatorio->resultados_obtidos}}</li>
      </ul>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">4. Coordenadores do Projeto</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-75"><b>Nome</b></th>
              <th class="bg-dark text-white w-25"><b>Carga Horária</b></th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosRelatorio->getCoordenador as $coordenador)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$coordenador->nome}}</td>
                <td>{{$coordenador->carga_horaria}} h</td>
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
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">5. Equipe Organizadora</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-75"><b>Nome</b></th>
              <th class="bg-dark text-white w-25"><b>Carga Horária</b></th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosRelatorio->getEquipeRelatorio as $equipe)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$equipe->nome}}</td>
                <td>{{$equipe->carga_horaria}} h</td>
              </tr>
            @empty  
              <tr>
                <td>-</td>
                <td>Não há equipe(s) cadastrada(s)</td>
                <td>-</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">6. Palestrantes</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-50">Nome</th>
              <th class="bg-dark text-white w-25">Título</th>
              <th class="bg-dark text-white w-25">Carga Horária</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosRelatorio->getPalestrante as $palestrante)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$palestrante->nome}}</td>
                <td>{{$palestrante->titulo}}</td>
                <td>{{$palestrante->carga_horaria}} h</td>
              </tr>
            @empty
              <tr>
                <td>-</td>
                <td>Não há palestrante(s) cadastrado(s)</td>
                <td>-</td>
                <td>-</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">7. Monitores</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-75">Nome</th>
              <th class="bg-dark text-white w-25">Carga Horária</th>
            </tr>
          </thead>
          <tbody>
          @forelse($dadosRelatorio->getMonitor as $monitor)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$monitor->nome}}</td>
                <td>{{$monitor->carga_horaria}} h</td>
              </tr>
          @empty
              <tr>
                <td>-</td>
                <td>Não há monitor(es) cadastrado(s)</td>
                <td>-</td>
              </tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">8. Expositores</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-50">Nome</th>
              <th class="bg-dark text-white w-25">Título</th>
              <th class="bg-dark text-white w-25">Carga Horária</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosRelatorio->getExpositor as $expositor)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$expositor->nome}}</td>
                <td>{{$expositor->titulo}}</td>
                <td>{{$expositor->carga_horaria}} h</td>
              </tr>
            @empty
              <tr>
                <td>-</td>
                <td>Não há expositor(es) cadastrado(s)</td>
                <td>-</td>
                <td>-</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">9. Ministrantes</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-50">Nome</th>
              <th class="bg-dark text-white w-25">Título</th>
              <th class="bg-dark text-white w-25">Carga Horária</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosRelatorio->getMinistrante as $ministrante)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$ministrante->nome}}</td>
                <td>{{$ministrante->titulo}}</td>
                <td>{{$ministrante->carga_horaria}} h</td>
              </tr>
            @empty 
              <tr>
                <td>-</td>
                <td>Não há Ministrante(s) cadastrado(s)</td>
                <td>-</td>
                <td>-</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">10. Participantes</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-75">Nome</th>
              <th class="bg-dark text-white w-25">Carga Horária</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosRelatorio->getParticipante as $participante)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$participante->nome}}</td>
                <td>{{$participante->carga_horaria}} h</td>
              </tr>
            @empty 
              <tr>
                <td>-</td>
                <td>Não há participante(s) cadastrado(s)</td>
                <td>-</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">11. Ouvintes</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th class="bg-dark text-white">#</th>
              <th class="bg-dark text-white w-75">Nome</th>
              <th class="bg-dark text-white w-25">Carga Horária</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dadosRelatorio->getOuvinte as $ouvinte)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$ouvinte->nome}}</td>
                <td>{{$ouvinte->carga_horaria}} h</td>
              </tr>
            @empty 
              <tr>
                <td>-</td>
                <td>Não há participante(s) cadastrado(s)</td>
                <td>-</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="px-4 pt-4 ">
    <div class="row px-5 my-2">
      <div class="col-md-12">
        <h4 class="text-left">12. Parecer do Orientador/Responsável Institucional</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul class="list-group">
          <li class="list-group-item"><b>Classificação de Desempenho:</b>&nbsp; [{{$dadosRelatorio->parecer_responsavel == 'Excelente' ? 'X' :'  '}}] Excelente &nbsp; [{{$dadosRelatorio->parecer_responsavel == 'Bom' ? 'X' :'  '}}] Bom &nbsp; [{{$dadosRelatorio->parecer_responsavel == 'Regular' ? 'X' :'  '}}] Regular &nbsp; [{{$dadosRelatorio->parecer_responsavel == 'Insuficiente' ? 'X' :'  '}}] Insuficiente</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="py-5 px-2 my-3">
    <div class="row">
      <div class="col-md-12 "> </div>
    </div>
    <div class="row">
      <table class="table-sm col-md-12" style="boder: 0;">
        <tbody>
          <tr>
            <td class="w-50 pb-5">
              <h6 class="mx-5"><b>Local:&nbsp;</b>Vitória da Conquista - BA</h6>
            </td>
            <td></td>
            <td class="w-50 pb-5">
              <h6><b>Data:&nbsp;</b> {{date('d/m/Y')}}</h6>
            </td>
          </tr>
          <tr>
            <td class="w-50 px-5">
              <hr class="border border-dark text-center">
              <h3 class="text-center">Coordenador do projeto</h3>
            </td>
            <td></td>
            <td class="w-50 px-5">
              <hr class="border border-dark text-center">
              <h3 class="text-center">Coordenador do Curso / Setor</h3>
            </td>
          </tr>
          <tr>
            <td class="w-50 pt-3">
              <div class="mb-2">
                <h6 class="mx-5"> <b class="mb-1">Data:</b>&nbsp;{{date('d/m/Y')}}</h6>
              </div>
              <div class="mt-2">
                <h6 class="mx-5"><b class="mt-1">Parecer NAAC:</b>&nbsp;{{$dadosRelatorio->parecer_naac}}</h6>
              </div>
            </td>
            <td></td>
            <td></td>
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