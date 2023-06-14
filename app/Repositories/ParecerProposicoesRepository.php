<?php

namespace App\Repositories;

use App\Models\Parecer_proposicao;

Class ParecerProposicoesRepository extends BaseRepository{

    public function __construct(Parecer_proposicao $parecerProposicaoRepository){
        parent::__construct($parecerProposicaoRepository);
    }

}
