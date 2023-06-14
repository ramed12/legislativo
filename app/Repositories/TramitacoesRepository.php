<?php

namespace App\Repositories;

use App\Models\Tramitacoes;


Class TramitacoesRepository extends BaseRepository{

    public function __construct(Tramitacoes $tramitacoesRepository){
        parent::__construct($tramitacoesRepository);
    }


}

