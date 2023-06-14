<?php

namespace App\Repositories;

use App\Models\Parlamentar;


Class ParlamentarRepository extends BaseRepository{


    public function __construct(Parlamentar $parlamentarRepository){
        parent::__construct($parlamentarRepository);
    }

}
