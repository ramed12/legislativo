<?php

namespace App\Repositories;

use App\Models\Proposicoes;

Class ProposicoesRepository extends BaseRepository{

    protected $proposicoesRepository;
    public function __construct(Proposicoes $proposicoesRepository){
        parent::__construct($proposicoesRepository);
        $this->proposicoesRepository = $proposicoesRepository;
    }

    public function sendEmail($value){
        return $this->proposicoesRepository->sendEmail($value);
    }
}
