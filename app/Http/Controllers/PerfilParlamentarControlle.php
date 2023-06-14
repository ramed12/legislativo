<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\ParlamentarRepository;
use App\Repositories\AnotacoesRepository;
use App\Repositories\ProposicoesSeguidasRepository;
use Exception;

class PerfilParlamentarControlle extends Controller
{

    protected $parlamentarRepository;
    protected $anotacoesRepository;
    protected $propoSeguidasRepository;
    public function __construct(ParlamentarRepository $parlamentarRepository, AnotacoesRepository $anotacoesRepository, ProposicoesSeguidasRepository $propoSeguidasRepository){
        $this->parlamentarRepository = $parlamentarRepository;
        $this->anotacoesRepository   = $anotacoesRepository;
        $this->propoSeguidasRepository = $propoSeguidasRepository;
    }
    public function index(Request $request){
        $paginate     = 9;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return view('dash.parlamentar.index', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Pesquisa do partlamentar", "class" => "active"],
            ],
            "parlamentar" => $this->parlamentarRepository->list($request, $orderByField, $orderByOrder, $paginate)
        ]);
    }

    public function perfil($id, Request $request){

        if(empty($id)){
            abort(404);
        }
        $findParlamentar = $this->parlamentarRepository->where('nano_id', $id);
        $findParlamentar->perfil = $request->input('perfil');

        try {

            $findParlamentar->save();
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Perfil adicional inserido com sucesso']);
        }catch(Exception $e){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro interno, comunique ao desenvolvedor']);
        }

        return redirect()->route('parlamentar.show', $id);
    }

    public function show($id, Request $request){
        if(empty($id)){
            abort(404);
        }

        $parlamentar = $this->parlamentarRepository->where("nano_id", $id);


        if(empty($parlamentar)){
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Parlamentar não encontrado']);
            return redirect()->route('parlamentar');
        }


        $parlamentar->setRelation('proposicoes', $parlamentar->proposicoes()->paginate(10));
        $parlamentar->setRelation('licencas', $parlamentar->licencas()->paginate(10));


        return view('dash.parlamentar.show', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Parlamentar", "class" => null],
                ["route" => route('dashboard'), "name" => $parlamentar->name, "class" => "active"],
            ],
            "parlamentar" => $parlamentar,
            "propoSeguidas" => $this->propoSeguidasRepository->whereS('nano_id', $id)->count()
        ]);
    }

    public function anotacoes($id, Request $request){

        if(empty($id)){
            abort(404);
        }

        $request->merge([
            "user"      => $request->user()->id,
            "nano_id"   => $id
        ]);

        try{
            $this->anotacoesRepository->create($request->input());
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Anotação inseriada com sucesso']);
        }catch(Exception $e){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro na aplicação']);
        }

        return redirect()->route('parlamentar.show', $id);

    }

}
