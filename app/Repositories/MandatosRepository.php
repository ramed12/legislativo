<?php

namespace App\Repositories;

use App\Models\Mandatos;


Class MandatosRepository extends BaseRepository{

    public function __construct(Mandatos $mandatosRepository){
        parent::__construct($mandatosRepository);
    }

}
