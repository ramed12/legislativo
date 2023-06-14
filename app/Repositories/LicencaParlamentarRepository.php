<?php

namespace App\Repositories;

use App\Models\LicencaParlamentar;


Class LicencaParlamentarRepository extends BaseRepository{

    public function __construct(LicencaParlamentar $licencaParlamentarRepository){
        parent::__construct($licencaParlamentarRepository);
    }

}
