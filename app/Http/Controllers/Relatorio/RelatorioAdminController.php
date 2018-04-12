<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Relatorio;

class RelatorioAdminController extends Controller
{
    

    public function todosRelatoriosAdmin(Relatorio $relatorio)
    {
        $relatorios = $relatorio->all();

        return view('relatorio.relatorio.view', compact('relatorios'));
    }

    public function relatoriosSolicitados(Relatorio $relatorio)
    {
        $messageTitle = 'Relatórios solicitados';
        $messageEmpty = 'Não há relatório(s) solicitado(s)';
        $relatorios = $relatorio
                            ->where('status_relatorio', 'Enviado')
                            ->get();
        //dd($relatorios);
        return view('relatorio.relatorio.view', compact('relatorios', 'messageTitle', 'messageEmpty'));
    }

    public function relatoriosCorrigir(Relatorio $relatorio)
    {
        $messageTitle = 'Relatórios Reenviados';
        $messageEmpty = 'Não há relatório(s) reenviado(s)';
        $relatorios = $relatorio
                            ->where('status_relatorio', 'Reenviado')
                            ->get();
                            
        return view('relatorio.relatorio.view', compact('relatorios', 'messageTitle', 'messageEmpty'));
    }

    public function relatoriosDeferidos(Relatorio $relatorio)
    {
        $messageTitle = 'Relatórios Reenviados';
        $messageEmpty = 'Não há relatorio(s) deferido(s)';
        $relatorios = $relatorio
                            ->where('status_relatorio', 'Deferido')
                            ->get();

        return view('relatorio.relatorio.view', compact('relatorios', 'messageTitle', 'messageEmpty'));
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
