<?php

namespace App\Repositories;

use App\Models\ProposicoesSeguidas;

Class ProposicoesSeguidasRepository extends BaseRepository{

    public function __construct(ProposicoesSeguidas $prosicoesSeguidasRepository){
        parent::__construct($prosicoesSeguidasRepository);
    }

}
