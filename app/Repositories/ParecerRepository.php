<?php

namespace App\Repositories;

use App\Models\Parecer;


Class ParecerRepository extends BaseRepository{

    public function __construct(Parecer $parecerRepository){
        parent::__construct($parecerRepository);
    }


}

