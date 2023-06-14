<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParecerEditRequest;
use App\Http\Requests\ParecerRequest;
use Illuminate\Http\Request;
use App\Repositories\ParecerRepository;
use  App\Repositories\PalavrasChavesRepository;
use Exception;

class ConfiguracoesController extends Controller
{
    protected $parecerRepository;
    protected $palavrasChavesRepository;

    public function __construct(ParecerRepository $parecerRepository, PalavrasChavesRepository $palavrasChavesRepository){
        $this->parecerRepository = $parecerRepository;
        $this->palavrasChavesRepository = $palavrasChavesRepository;
    }

    public function index(){


        $consulta =\DB::table('palavras_chaves')->orderBy('id', 'desc')->first()->chave;

        //dd($this->parecerRepository->all());

        return view('dash.configuracoes.index', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Configurações", "class" => "active"],
            ],
            'parecer' => $this->parecerRepository->all(),
            'palavrasChaves' => json_decode($consulta, true)
        ]);
    }

    public function insereParecer(ParecerRequest $request){
        try {
            $request->merge(["user" => $request->user()->id]);
            $this->parecerRepository->create($request->input());
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Parecer Técnico criado com sucesso']);
        }catch(Exception $e){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro interno, comunique ao desenvolvedor']);
        }
        return redirect()->route('configurador');
    }

    public function editParecer($id, ParecerEditRequest $request){

        if(empty($id)){
            abort(404);
        }

        $findParecer = $this->parecerRepository->find($id);

        if(empty($findParecer)){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Não encontramos nenhum parecer com esse identificador']);
           return redirect()->route('configurador');
        }
        $request->merge(['user' => $request->user()->id]);

        try {
            $this->parecerRepository->update($request->input(), $id);
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Parecer editado com sucesso']);

        }catch(Exception $e){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro interno, comunique ao desenvolvedor']);
        }
        return redirect()->route('configurador');

    }

    public function inserPalavrasChaves(Request $request){
        try {
            $request->merge(["chave" => json_encode($request->chave), "user" => $request->user()->id]);
            $this->palavrasChavesRepository->create($request->input());

            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Palavras Chaves adicinada com sucesso']);
        }catch(Exception $e){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro interno, comunique ao desenvolvedor']);
        }
        return redirect()->route('configurador');

    }

}
