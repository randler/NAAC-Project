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
        <img class="img-fluid d-block" src="{{base_path()}}/public/assets/img/ftc.jpg" width="120px"> 
    </div>
    <div class="col-md-8">
        <div class="col-md-12 text-center">
        <h4>Formulário NAAC-DOC-004 Versão 1.0</h4>
        <h5>Lista de Presença para Projeto de Extensão</h5>
        </div>
    </div>
    <div class="col-md-2 text-right">
        <img class="img-fluid d-block" src="{{base_path()}}/public/assets/img/naac.jpg" width="70px"> 
    </div>
    </div>
    <div class="py-1">
              <div class="row">
                <div class="col-md-12">
                  <ul class="list-group">
                    <li class="list-group-item text-center my-1 border border-dark">
                      <h2 class="m-3">{{$dadosProject->titulo_projeto}}</h2>
                    </li>
                  </ul>
                </div>
              </div>
          </div>
          <div class="row">
                <div class="col-md-4">
                  <ul class="list-group">
                    <li class="list-group-item text-center"><b>Data : </b>___/___/______  <b>Turno : </b>___________________ <b>Folha :</b> ______</li>
                  </ul>
                </div>
          </div>
          <div class="py-2">
              <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">
                    <li class="list-group-item">
                    <p class="">Presença de :&nbsp; <span class="text-danger">(Marcar Apenas uma opção)</span></p>
                    <div class="row">
                        <div class="col-md-3"> (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp; Equipe Organizadora </div>
                        <div class="col-md-3 text-center"> (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp; Monitores </div>
                        <div class="col-md-3 text-right"> (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp; Expositores </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"> (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp; Participantes </div>
                        <div class="col-md-3 text-center"> (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp; Ouvintes </div>
                    </div>
                    </li>
                    </ul>
                </div>
              </div>
            <div class="py-3">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>Nº</th>
                                <th class="w-50">Nome</th>
                                <th class="w-50">Assinatura</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < 40; $i++)
                                <tr>
                                    <td>{{($i +1)}}</td>
                                    <td style="border-bottom-color:black"></td>
                                    <td style="border-bottom-color:black"></td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
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
        <div class="py-5 my-3">
                <div class="row">
                  <div class="col-md-12 ">
                  </div>
                </div>
                <div class="row">
                  <table class="table-sm col-md-12" style="boder: 0;">
                    <tbody>
                      <tr>
                        <td></td>
                        <td class="w-50 text-center">
                            <h5 class="text-center">Vitória da Conquista, ___/___/______.</h5></td>
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
