<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Relatorio;

class RelatorioAdminController extends Controller
{
    

    public function todosRelatoriosAdmin(Relatorio $relatorio)
    {
        $messageTitle = 'Todos os Relatórios';
        $messageEmpty = 'Não há relatório(s) cadastrado(s)';
        $statusFind = 'all';

        $relatorios = $relatorio->all();

        return view('relatorio.relatorio.view', compact('relatorios', 'messageTitle', 'messageEmpty', 'statusFind'));
    }

    public function relatoriosSolicitados(Relatorio $relatorio)
    {
        $messageTitle = 'Relatórios solicitados';
        $messageEmpty = 'Não há relatório(s) solicitado(s)';
        $statusFind = 'Enviado';

        $relatorios = $relatorio
                            ->where('status_relatorio', 'Enviado')
                            ->get();
        //dd($relatorios);
        return view('relatorio.relatorio.view', compact('relatorios', 'messageTitle', 'messageEmpty', 'statusFind'));
    }

    public function relatoriosCorrigir(Relatorio $relatorio)
    {
        $messageTitle = 'Relatórios a corrigir';
        $messageEmpty = 'Não há relatório(s) a corrigir';
        $statusFind = 'Reenviado';

        $relatorios = $relatorio
                            ->where('status_relatorio', 'Reenviado')
                            ->get();
                            
        return view('relatorio.relatorio.view', compact('relatorios', 'messageTitle', 'messageEmpty', 'statusFind'));
    }

    public function relatoriosDeferidos(Relatorio $relatorio)
    {
        $messageTitle = 'Relatórios Deferidos';
        $messageEmpty = 'Não há relatorio(s) deferido(s)';
        $statusFind = 'Deferido';

        $relatorios = $relatorio
                            ->where('status_relatorio', 'Deferido')
                            ->get();

        return view('relatorio.relatorio.view', compact('relatorios', 'messageTitle', 'messageEmpty', 'statusFind'));
    }

    public function exibirCorrigirRelatorioAdmin(int $id, $notify_id = '', Relatorio $relatorio)
    {
        $dadosRelatorio = $relatorio
                                    ->where('id', $id)
                                    ->with([
                                        'getCoordenador',
                                        'getCronograma',
                                        'getEquipeRelatorio',
                                        'getExpositor',
                                        'getMinistrante',
                                        'getMonitor',
                                        'getOuvinte',
                                        'getPalestrante',
                                        'getParticipante'])
                                    ->get()
                                    ->first();
        //dd($dadosRelatorio);
        return view('relatorio.relatorio.visualizar-relatorio', compact('dadosRelatorio'));
    }

    public function procurarRelatorio(Request $request, Relatorio $relatorio)
    {
        $messageTitle = isset($request->messageTitle) ? $request->messageTitle : '';
        $messageEmpty = 'Nenhum relatório encontrado!';
        $statusFind = $request->statusFind;
        //dd($request->all());
        $relatorios = $relatorio->procurarRelatorio($request->all());
        //dd($relatorios);

        return view('relatorio.relatorio.view', compact('relatorios', 'messageTitle', 'messageEmpty', 'statusFind'));

    }

    public function salvarCorrigirRelatorio(int $id, Request $request, Relatorio $relatorio)
    {
        //dd($id, $request->all());
        $dataForm = $request->all();
        //dd($dataForm);
        $responseIndeferir = $relatorio->salvarCorrigirRelatorio($id, $request->all());
        
        if ($responseIndeferir['success']) {
            return redirect()
                        ->route('home')
                        ->with('success', $responseIndeferir['message']);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $responseIndeferir['message']);
        }
    }

    public function deferirRelatorio(int $id, Relatorio $relatorio)
    {
        //dd($id);
        $responseDeferir = $relatorio->deferirRelatorio($id);
        //dd($responseDeferir);
        if ($responseDeferir['success']) {
            return redirect()
                        ->route('home')
                        ->with('success', $responseDeferir['message']);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $responseDeferir['message']);
        }
    }
}
