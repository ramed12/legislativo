<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Graficos\Layouts;
use App\Repositories\ProposicoesRepository;

class HomeController extends BaseWebController
{

    protected $layout;
    protected $proposicoesRepository;
    public function __construct(Layouts $layout, ProposicoesRepository $proposicoesRepository){
        $this->middleware(function ($request, $next) {
            $this->id = Auth::guard('web')->user();
            parent::__construct($this->id, $request);
            return $next($request);
        });
        $this->layout                = $layout;
        $this->proposicoesRepository = $proposicoesRepository;
    }
    public function index(){

        $porAno = $this->layout->propositurasPorAno($this->proposicoesRepository);

        $chartjs = app()->chartjs
        ->name('proposituras_anual')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['2019', '2020', '2021', '2023'])
        ->datasets([
            [
                "label" => [""],
                // 'backgroundColor' => "rgba(242, 116, 5, 0.7)",
                'data' => [65, 59, 80, 81],
            ]
        ])
        ->options([]);


        $proposicoes = app()->chartjs
        ->name('favoravel')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Posições'])
        ->datasets([
            [
                "label" => ["Favoravel"],
                'data' => [65],
            ],
            [
                "label" => ["Não Favoravel"],
                'data' => [15],
            ],
            [
                "label" => ["Pendente"],
                'data' => [7],
            ]
        ])
        ->options([]);


        $fases = app()->chartjs
        ->name('fases')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Posições'])
        ->datasets([
            [
                "label" => ["Encerrada"],
                'data' => [65],
            ],
            [
                "label" => ["Em tramitação"],
                'data' => [15],
            ]
        ])
        ->options([]);


        $status = app()->chartjs
        ->name('doughnut')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Baixa'])
        ->datasets([
            [
                "label" => ["Baixa"],
                'data' => [240],
            ],
            [
                "label" => ["Média"],
                'data' => [225],
            ],
            [
                "label" => ["Alta"],
                'data' => [97],
            ]
        ])
        ->options([]);




        // $prioridade = app()->chartjs
        // ->name('proposituras_prioridade')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['Media', 'Baixa', 'Alta'])
        // ->datasets([
        //     [
        //         "label" => "Proposituras",
        //         'backgroundColor' => "rgba(217, 91, 114, 0.7)",
        //         'data' => [65, 59, 80],
        //     ]
        // ])
        // ->options([
        //     "indexAxis" => 'y'
        // ]);



        // $status = app()->chartjs
        // ->name('proposituras_status')
        // ->type('doughnut')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['Em tramitação', 'Encerrada'])
        // ->datasets([
        //     [
        //         "label" => "Em tramitação",
        //         'data' => [65, 100],
        //     ]
        // ])
        // ->options([]);


        // $tipo = app()->chartjs
        // ->name('proposituras_tipo')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(["Projeto de lei", "Projeto de lei complementar", "Projeto de Emenda Constitucional"])
        // ->datasets([
        //     [
        //         "label" => [],
        //         'backgroundColor' => "rgba(242, 116, 5, 0.7)",
        //         'data' => [394, 100, 50],
        //     ],
        // ])
        // ->options([]);


        // $interesse = app()->chartjs
        // ->name('proposituras_interesse')
        // ->type('pie')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(["Interesse Geral", "Interesse setorial"])
        // ->datasets([
        //     [
        //         "label" => [],
        //         'data' => [254, 150],
        //     ],
        // ])
        // ->options([]);


        // $fases = app()->chartjs
        // ->name('proposituras_fases')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(["Comissão de Mérito", "1ª Votação", "CCJ", "2ª Votação", "Sem Votação"])
        // ->datasets([
        //     [
        //         "label" => [],
        //         'backgroundColor' => "rgba(242, 116, 5, 0.7)",
        //         'data' => [172, 8, 78, 126, 65],
        //     ],
        // ])
        // ->options([]);


        // $proposituras = app()->chartjs
        // ->name('jose')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(["2022", "2023"])
        // ->datasets([
        //     [
        //         "label" => [2022],
        //         // 'backgroundColor' => "rgba(217, 91, 114, 0.7)",
        //         'data' => [175],
        //     ], [
        //         "label" => [2023],
        //         // 'backgroundColor' => "rgba(217, 91, 114, 0.7)",
        //         'data' => [150],
        //     ],
        // ])
        // ->options([]);




        return view('dash.index', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Dashboard", "class" => "active"],
            ],
            "proposituras" => $chartjs->render(),
            "favoravel"    => $proposicoes->render(),
            "fases"        => $fases->render(),
            "status"       => $status->render()
        ]);

        // return view('mail.notificacaoproposicao');
    }
}
