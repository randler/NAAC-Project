<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>NAAC | E-mail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Heebo');
  </style>
</head>
<body style="margin: 0; padding: 0; font-family: 'Heebo', cursive;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td>
              <table style="border: 1px solid #cccccc; border-collapse: collapse;" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                  <tr>
                    <td align="center" bgcolor="#60b1e4" style="padding: 40px 0 30px 0; color:#1e4157;">
                      <img src="{{ $message->embed(public_path() . '/assets/img/naac.png') }}" alt="NAAC - Núcle de Acompanhamento de Ações Acadêmicas" width="166" height="111" style="display: block;" />
                      <h1>NAAC</h1>
                      <p>Núcle de Acompanhamento de Ações Acadêmicas</p>
                    </td>
                  </tr>
                  <tr>
                  <td bgcolor="#ffffff">
                    <table style="padding: 20px 20px 30px 20px;" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                        <b>{{$dadosEmail->title}}</b>
                        </td>
                      </tr>
                      <tr>
                        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; padding: 20px 0 30px 0;">
                          {{$dadosEmail->title_message}}
                        </td>
                      </tr>
                      <tr>
                        <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            <td width="260" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr>
                              <td align="center">
                                <img src="{{ $message->embed(public_path() . '/assets/img/arquivo.png') }}" alt="" width="105" height="134" style="display: block;" />
                              </td>
                              </tr>
                              <tr>
                              <td style="padding: 5px 75px 5px 75px; text-align: justify">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                  <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;" width="70%"><b>Título:</b> {{$dadosEmail->titulo}}</td>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;" width="30%"><b>Status:</b> {{$dadosEmail->status}}</td>
                                  </tr>
                                </table> 
                              </td>
                              </tr>
                              <tr>
                              <td  style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; padding: 5px 75px 5px 75px; text-align: justify">
                                <b>Autor:</b> {{$dadosEmail->autor}}
                              </td>
                              </tr>
                              <tr>
                              <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; padding: 5px 75px 5px 75px; text-align: justify">
                                <b>Descrição:</b>{{$dadosEmail->descricao}} 
                              </td>
                              </tr>
                              <tr>
                                <td style="padding: 30px 30px 30px 30px; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;" align="center">
                                @if ($dadosEmail->tipo == 'novo-usuario')
                                  <a class="btn btn-block btn-primary" href="{{$dadosEmail->link}}"> Ver <i class="fas fa-user"></i></a>
                                @else
                                  @if ($dadosEmail->status == 'Enviado' || $dadosEmail->status == 'new-user' || $dadosEmail->status == 'Corrigido' || $dadosEmail->status == 'Deferido')
                                  <a href="{{$dadosEmail->link}}">
                                    <img src="{{ $message->embed(public_path() . '/assets/img/success.png') }}" alt="" width="150" height="45" style="display: block;" />
                                  </a>
                                  @endif
                                  @if ($dadosEmail->status == 'Indeferido')
                                    <a href="{{$dadosEmail->link}}">
                                      <img src="{{ $message->embed(public_path() . '/assets/img/error.png') }}" alt="" width="150" height="45" style="display: block;" />
                                    </a>
                                  @endif
                                @endif
                                </td>
                              </tr>
                            </table>
                            </td>
                          </tr>
                          </table>
                        </td>
                      </tr>
                      </table>
                  </td>
                  </tr>
                  <tr>
                  <td bgcolor="#11527a" style="padding: 30px 30px 30px 30px; color: #ffffff;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                          <td style="font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;" width="75%">
                          &reg; NAAC | FTC<br/>
                           Por Favor não responda a esse e-mail
                          </td>
                        <td align="right">
                        <table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                          <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                          <td>
                            <a href="{{$link_face}}">
                            <img src="{{ $message->embed(public_path() . '/assets/img/social-facebook.png') }}" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                            </a>
                          </td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                      </table>
                  </td>
                  </tr>
              </table>
   </td>
  </tr>
 </table>
</body>
</html>
