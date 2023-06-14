<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\Proposicoes\Tramitacoes\Import;

use App\Api\ApiAL;

class TramitacoesController extends Controller
{
    protected $tramitacoesImport;
    protected $apiAL;
    public function __construct(ApiAL $apiAL, Import $tramitacoesImport){
        $this->tramitacoesImport =  $tramitacoesImport;
        $this->apiAL = $apiAL;
    }

    public function importTramitacoes(){
        return  $this->tramitacoesImport->Search($this->apiAL->BearerReturn());

    }
}
