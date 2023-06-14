<?php

namespace App\Api\Proposicoes;
use Illuminate\Support\Facades\Http;
use App\Repositories\ProposicoesRepository;

Class Import{

    protected $proposicoesRepository;
    public function __construct(ProposicoesRepository $proposicoesRepository){
        $this->proposicoesRepository = $proposicoesRepository;
    }

    public function Search($token){
        $response = Http::withToken($token->access_token)
        ->get("https://api.al.mt.gov.br/api/v1/ssl/proposicao/");
        return $this->create($response->json());
    }

    public function create($value){
        foreach($value['entities'] as $b){
            $findProposicoes = $this->proposicoesRepository->where('id_api', $b['id']);
            if(is_null($findProposicoes)){
                $proposicoes = [
                    "id_api" => $b['id'],
                    "tipo"=> $b['tipo']['descricao'],
                    "nano_id"=> $b['autor']['cadastro_politico']['id'],
                    "coautores"=> json_encode($b['coautores']),
                    "ementa"=> $b['ementa'],
                    "codigo"=> $b['codigo'],
                    "arquivo"=> $b['arquivo'],
                    "data_leitura"=> $b['data_leitura']['date'],
                    "data_fim" => !empty($b['data_fim']) ? $b['data_fim'] : null,
                    "processo" => json_encode($b['processo']), //json
                    "conteudo" => json_encode($b['conteudo']),//json
                    "justificativa" => json_encode($b['justificativa']),//json
                    "anexos" => json_encode($b['anexos']),//json
                    "url"=> !empty($b['url']) ? $b['url'] : null,
                    "protocoloP" => json_encode($b['protocoloP']),
                    "ano_proposicao" => date('Y', strtotime($b['data_leitura']['date']))
                ];

                $this->proposicoesRepository->create($proposicoes);
                $this->proposicoesRepository->sendEmail($proposicoes);

            }
        }
    }
}
