<?php

namespace App\Api\Parlamentar;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Repositories\ParlamentarRepository;
use App\Repositories\MidiasRepository;
use App\Repositories\MandatosRepository;
use App\Repositories\FiliacoesRepository;
use App\Repositories\ContatosRepository;
use App\Repositories\LicencaParlamentarRepository;


Class Import{

    protected $parlamentarRepository;
    protected $midiasRepository;
    protected $mandatosRepository;
    protected $filiacoesRepository;
    protected $contatosRepository;
    protected $licencaParlamentarRepository;
    public function __construct(
        ParlamentarRepository $parlamentarRepository,
        MidiasRepository $midiasRepository,
        MandatosRepository $mandatosRepository,
        FiliacoesRepository $filiacoesRepository,
        ContatosRepository $contatosRepository,
        LicencaParlamentarRepository $licencaParlamentarRepository)
    {
        $this->parlamentarRepository        = $parlamentarRepository;
        $this->midiasRepository             = $midiasRepository;
        $this->mandatosRepository           = $mandatosRepository;
        $this->filiacoesRepository          = $filiacoesRepository;
        $this->contatosRepository           = $contatosRepository;
        $this->licencaParlamentarRepository = $licencaParlamentarRepository;
    }

    public function Search($token){
        dd($token->access_token);
        $response = Http::withToken($token->access_token)
        ->get("https://api.al.mt.gov.br/api/v1/ssl/parlamentar");
        return $this->create($response->json());
    }


    public function create($value){

        foreach($value['entities'] as $b){

            // dd($b);

            $findParlamentar = $this->parlamentarRepository->where('nano_id', $b['id']);
            if(is_null($findParlamentar)){
                $user = [
                    "name" => $b['pessoa_fisica']['nome'],
                    "cpf" =>$b['pessoa_fisica']['cpf'],
                    "data_nascimento" => date('Y-m-d', strtotime($b['pessoa_fisica']['data_nascimento'])),
                    "sexo" => $b['pessoa_fisica']['sexo'],
                    "cidade_nascimento" => (!empty($b['pessoa_fisica']['cidade_nascimento']) ? json_encode($b['pessoa_fisica']['cidade_nascimento']) : "{}"),
                    "nano_id"           => $b['id'],
                    "estado" => "{}",
                    "fotografia" => $b['fotografia'],
                    "status"     => $b['status'],
                    "biografia"  => $b['biografia']
                ];

                $createUser = $this->parlamentarRepository->create($user);

                if($createUser){
                    $midias = $this->midiasRepository->where('nano_Id', $b['id']);

                    // Adiciona as midias quanto passa pelo IF
                    if(is_null($midias)){
                        $midiasSociais = [
                            "midias" => json_encode($b['midias_sociais']),
                            "nano_id" => $b['id']
                        ];

                        $this->midiasRepository->create($midiasSociais);
                    }
                }
            }


            //dd($mandatos);
            foreach($b['mandatos'] as $md){

                $mandatos =  $this->mandatosRepository->where('id_api', $md['id']);
                if(is_null($mandatos)){
                    $mandatos_s = [
                        "id_api" => $md['id'],
                        "nome"   => $md['nome'],
                        "inicio" =>$md['inicio'],
                        "fim"    =>$md['fim'],
                        "diploma" =>$md['diploma'],
                        "votos"       =>$md['voto'],
                        "nano_id"     => $b['id'],
                        "legislatura" => json_encode($md['legislatura']),
                        "colignacao"  => json_encode($md['coligacao'])
                    ];

                    $this->mandatosRepository->create($mandatos_s);

                }
            }

            //Filiacoes
            foreach($b['filiacoes'] as $fl){
                $filiacoes = $this->filiacoesRepository->where('id_api', $fl['id']);
                if(is_null($filiacoes)){
                    $filiacoes_s = [
                        "id_api" => $fl['id'],
                        "nano_id" => $b['id'],
                        "inicio" =>$fl['inicio'],
                        "fim"    =>!empty($fl['fim']) ? $fl['fim'] : null,
                        "partido" =>json_encode($fl['partido'])
                    ];
                    $this->filiacoesRepository->create($filiacoes_s);
                }
            }

            // contatos
            foreach($b['contatos'] as $ct){
                $contatos = $this->contatosRepository->where('id_api', $ct['id']);
                if(is_null($contatos)){
                    $filiacoes_s = [
                        "id_api" => $ct['id'],
                        "nano_id" => $b['id'],
                        "tipo"    =>$ct['tipo'],
                        "valor"   =>$ct['valor'],
                        "observacao" => $ct['observacao']
                    ];
                    $this->contatosRepository->create($filiacoes_s);
                }
            }

            //Licença parlamentar
            foreach($b['licencas_parlamentares'] as $pl){
                $parlamentar = $this->licencaParlamentarRepository->where('id_api', $ct['id']);
                if(is_null($parlamentar)){
                    $licenca_s = [
                        "id_api" => $pl['id'],
                        "nano_id" => $b['id'],
                        "diario_oficial" => date('Y-m-d', strtotime($pl['diario_oficial'])),
                        "apresentacao" => json_encode($pl['apresentacao']),
                        "motivo"    =>$pl['motivo'],
                        "periodo"   => json_encode($pl['periodo']),
                        "concessao" => json_encode($pl['concessao']),
                        "observacao" => $pl['observacao']
                    ];
                    $this->licencaParlamentarRepository->create($licenca_s);
                }
            }
        }
    }
}


