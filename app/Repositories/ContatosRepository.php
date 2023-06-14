<?php

namespace App\Repositories;

use App\Models\Contatos;


Class ContatosRepository extends BaseRepository{

    public function __construct(Contatos $contatosRepository){
        parent::__construct($contatosRepository);
    }

}
