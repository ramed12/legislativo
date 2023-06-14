<?php

namespace App\Repositories;

use App\Models\Anotacoes;


Class AnotacoesRepository extends BaseRepository{


    public function __construct(Anotacoes $anotacoesRepository){
        parent::__construct($anotacoesRepository);
    }

}
