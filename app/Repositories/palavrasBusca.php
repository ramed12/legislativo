<?php

namespace App\Repositories;

use App\Models\PalavrasBusca;


Class PalavrasChavesRepository extends BaseRepository{

    public function __construct(PalavrasBusca $palavrasBusca){
        parent::__construct($palavrasBusca);
    }

}
