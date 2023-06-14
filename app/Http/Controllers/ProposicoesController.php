<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Api\Proposicoes\Import;
use App\Api\ApiAL;
use App\Repositories\ProposicoesRepository;
use App\Repositories\ProposicoesSeguidasRepository;
use App\Repositories\AnotacoesRepository;
use App\Repositories\ParecerRepository;
use App\Repositories\ParecerProposicoesRepository;
use App\Models\Notificacao;

use Exception;


class ProposicoesController extends Controller
{
    protected $proposicoesImport;
    protected $apiAL;
    protected $proposicoesRepository;
    protected $propoSeguidasRepository;
    protected $anotacoesRepository;
    protected $parecerRepository;
    protected $parecerProposicoesRepository;
    public function __construct(ApiAL $apiAL,
    Import $proposicoesImport,
    ProposicoesRepository $proposicoesRepository,
    ProposicoesSeguidasRepository $propoSeguidasRepository,
    AnotacoesRepository $anotacoesRepository,
    ParecerRepository $parecerRepository,
    ParecerProposicoesRepository $parecerProposicoesRepository
    ){
        $this->proposicoesImport            =  $proposicoesImport;
        $this->apiAL                        = $apiAL;
        $this->proposicoesRepository        = $proposicoesRepository;
        $this->propoSeguidasRepository      = $propoSeguidasRepository;
        $this->anotacoesRepository          = $anotacoesRepository;
        $this->parecerRepository            = $parecerRepository;
        $this->parecerProposicoesRepository = $parecerProposicoesRepository;
    }

    public function importProposicoes(){
        return  $this->proposicoesImport->Search($this->apiAL->BearerReturn());
    }

    public function show($id_proposicao){
        if(empty($id_proposicao)){
            abort(404);
        }

        $parecer = $this->parecerRepository->all();

        $findProposicoes = $this->proposicoesRepository->where('id_api', $id_proposicao);

        return view('dash.proposicoes.show', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Proposicoes", "class" => 'active'],
            ],
            "proposicoes" => $findProposicoes,
            "parecer"     => $parecer
        ]);
    }

    public function parecerProposicao($id, Request $request){
        $request->merge([
            "id_proposicao" => $id,
            "texto"         => json_encode($request->input('texto')),
            "id_user"       => $request->user()->id
        ]);

        try {
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Parecer inserido com sucesso']);
            $this->parecerProposicoesRepository->create($request->except('_token'));
        }catch(Exception $e){
            $request->session()->flash('alert', ["code" => 'danger', 'text' => 'Erro interno, comunique ao desenvolvedor'. $e->getMessage()]);
        }

        return redirect()->route('tramitacao', $id);
    }

    public function removeParecer($id, $id_tramitacao, Request $request){
        if(empty($id)){
            abort(404);
        }

        try {
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Parecer removido com sucesso']);
            $this->parecerProposicoesRepository->destroy($id);
        }catch(Exception $e){
            $request->session()->flash('alert', ["code" => 'danger', 'text' => 'Erro interno, comunique ao desenvolvedor'. $e->getMessage()]);
        }

        return redirect()->route('tramitacao', $id_tramitacao);
    }
    public function follow($id, Request $request){

        if(empty($id)){
            abort(404);
        }

        $findProposicao = $this->proposicoesRepository->where('id_api', $id);

        $findProposicoesSeguidas = $this->propoSeguidasRepository->where('id_proposicao', $id);

        if(!empty($findProposicoesSeguidas)){
            $request->session()->flash('alert', ['code' => 'warning', 'text' => 'Opss essa proposição já está sendo seguida']);
            return redirect()->route('tramitacao', $id);
        }


        if(!empty($findProposicao)){

            $request->merge([
                "id_proposicao" => $id,
                "nano_id"       => $findProposicao->nano_id,
                "user"          => $request->user()->id
            ]);


            try{
                $this->propoSeguidasRepository->create($request->all());
                $request->session()->flash('alert', ['code' => 'success', 'text' => 'Proposição seguida com sucesso!!']);
                $findProposicao->status = 1; // Está sendo seguida;
                $findProposicao->save(); //Atualiza pois está sendo seguida
                if($request->type == 1){
                    return redirect()->route('parlamentar.show', $request->parlamentar);
                } elseif($request->type == 2) {
                    return redirect()->route('tramitacao', $id);
                } else {
                    return redirect()->route('proposicoes.seguidas');
                }

            }catch(Exception $e){
                $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro interno! Comunique ao desenvolvedor']);
                return redirect()->route('tramitacao', $id);
            }
        }

                $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Proposição não encontrada']);
                return redirect()->route('tramitacao', $id);
    }


    public function propoFollow(Request $request){

        $consulta =\DB::table('palavras_chaves')->orderBy('id', 'desc')->first()->chave;

        $paginate     = 9;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return view('dash.proposicoes.seguidas.index', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Proposicoes Seguidas", "class" => 'active'],
            ],
            'palavrasChaves' => json_decode($consulta, true),
            "prop" => $this->proposicoesRepository->listProposicoes($request, $orderByField, $orderByOrder, $paginate)
        ]);
    }


    public function notificacao($id, Request $request){
        try {
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Notificação lida com sucesso']);
            $notificacao = Notificacao::find($id)->update(['status' => null]);
        } catch(Exception $e){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro interno, comunique ao desenvolvedor'. $e->getMessage()]);
        }

        return redirect()->route('dashboard');
    }

    public function all(Request $request){

        $consulta =\DB::table('palavras_chaves')->orderBy('id', 'desc')->first()->chave;

        $paginate     = 9;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return view('dash.proposicoes.all.index', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Todas as proposições", "class" => 'active'],
            ],
            'palavrasChaves' => json_decode($consulta, true),
            "props" => $this->proposicoesRepository->listProposicoes($request, $orderByField, $orderByOrder, $paginate, 1)
        ]);
    }




    public function unfollow($id, Request $request){

        if(empty($id)){
            abort(404);
        }


        $findProposicao = $this->proposicoesRepository->where('id_api', $id);

        $findProposicoesSeguidas = $this->propoSeguidasRepository->where('id_proposicao', $id);

        if(empty($findProposicoesSeguidas)){
            $request->session()->flash('alert', ['code' => 'warning', 'text' => 'Proposição não está sendo seguida para seguir']);
            return redirect()->route('tramitacao', $id);
        }


        if(!empty($findProposicao)){


            try{
                $this->propoSeguidasRepository->remove($findProposicoesSeguidas->id);
                $request->session()->flash('alert', ['code' => 'success', 'text' => 'Proposição marcada como não seguida com sucesso!!']);
                $findProposicao->status = NULL; // já não está sendo seguida;
                $findProposicao->save(); //Atualiza pois já não está sendo seguida

                if($request->type == 1){
                    return redirect()->route('parlamentar.show', $request->parlamentar);
                } elseif($request->type == 2) {
                    return redirect()->route('tramitacao', $id);
                } else {
                    return redirect()->route('proposicoes.seguidas');
                }
            }catch(Exception $e){
                $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro interno! Comunique ao desenvolvedor']);
                return redirect()->route('tramitacao', $id);
            }
        }

                $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Proposição não encontrada']);
                return redirect()->route('tramitacao', $id);
    }


    public function anotacoesProposicoes($id, Request $request){
        if(empty($id)){
            abort(404);
        }

        $findProposicoes = $this->proposicoesRepository->where('id_api', $id);

        if(empty($findProposicoes)){
            return redirect()->route('dashboard');
        }


        if($request->hasFile('arquivos')){

            $file = $request->file('arquivos');
            $extension = $file->getClientOriginalExtension();

            $fileName = time().'.'.$extension;
            $path = public_path().'/arquivos';
            $uplaod = $file->move($path,$fileName);
        }

        $request->merge([
            "user" => $request->user()->id,
            "texto" => $request->texto,
            "nano_id" => $findProposicoes->user->nano_id,
            "id_proposicao" => $id,
            "arquivo" => $fileName
        ]);



        try{
            $this->anotacoesRepository->create($request->all());
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Anotação criada com sucesso']);
            return redirect()->route('tramitacao', $id);
        }catch(Exception $e){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => 'Erro interno, comunique ao desenvolvedor'. $e->getMessage()]);
            return redirect()->route('tramitacao', $id);
        }


    }

}
