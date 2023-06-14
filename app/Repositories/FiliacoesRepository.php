<?php

namespace App\Repositories;

use App\Models\Filiacoes;

Class FiliacoesRepository extends BaseRepository{

    public function __construct(Filiacoes $coligacoesRepository){
        parent::__construct($coligacoesRepository);
    }

}
