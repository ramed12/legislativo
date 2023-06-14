<?php

namespace App\Repositories;

use App\Models\Midias;


Class MidiasRepository extends BaseRepository{

    public function __construct(Midias $midiasRepository){
        parent::__construct($midiasRepository);
    }

}
