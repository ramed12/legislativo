<?php

namespace App\Api\Proposicoes\Tramitacoes;
use Illuminate\Support\Facades\Http;
use App\Repositories\ProposicoesRepository;
use App\Repositories\TramitacoesRepository;
use Exception;

Class Import{

    protected $proposicoesRepository;
    protected $tramitacoesRepository;

    public function __construct(ProposicoesRepository $proposicoesRepository, TramitacoesRepository $tramitacoesRepository){
        $this->proposicoesRepository = $proposicoesRepository;
        $this->tramitacoesRepository = $tramitacoesRepository;
    }


    public function search($token){
        $allProposicoes = $this->proposicoesRepository->all();
        foreach($allProposicoes as $b){
            $response = Http::withToken($token->access_token)
            ->get("https://api.al.mt.gov.br/api/v1/ssl/proposicao/{$b->id_api}/tramitacao");
            $this->create($response->json(), $b->id_api);
        }
    }
    public function create($value, $id_proposicao){
        if(!empty($value['entities'])){
            foreach($value['entities'] as $b){
                $findTramitacao = $this->tramitacoesRepository->where('id_api', $b['id']);
                if(empty($findTramitacao)){
                    $conteudo = [
                        "id_api"            => $b['id'],
                        "id_proposicao"     => $id_proposicao,
                        "descricao" => $b['descricao'],
                        "setor"     => $b['setor'],
                        "dataReg"   => json_encode($b['dataReg'])
                    ];
                    try {
                        $findProposicao = $this->proposicoesRepository->where('id_api', $id_proposicao);
                        $this->tramitacoesRepository->create($conteudo);
                        if($findProposicao->status == 1){
                            \Mail::send(new \App\Mail\SendNotificacaoTramitacao($findProposicao, $conteudo));
                        }
                    } catch(Exception $e){

                    }
                }
            }
        }
    }
}
