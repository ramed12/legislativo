<?php

namespace App\Http\Controllers;

use App\Api\ApiAL;
use App\Api\Parlamentar\Import;

class ParlamentarController extends Controller
{
    protected $apiAL;
    protected $importParlamentar;
    public function __construct(ApiAL $apiAL, Import $ImportParlamentar){
        $this->importParlamentar =  $ImportParlamentar;
        $this->apiAL = $apiAL;
    }

    public function ImportParlamentar(){
        return  $this->importParlamentar->Search($this->apiAL->BearerReturn());
    }


}
