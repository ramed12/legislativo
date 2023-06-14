<?php

namespace App\Repositories;

use App\Models\PalavrasChaves;


Class PalavrasChavesRepository extends BaseRepository{

    public function __construct(PalavrasChaves $palavrasChavesRepository){
        parent::__construct($palavrasChavesRepository);
    }

}
