<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramitacoes extends Model
{
    use HasFactory;

    protected $table = 'tramitacoes';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'id_api',
        'id_proposicao',
        'descricao',
        'setor',
        'dataReg'
    ];
}
