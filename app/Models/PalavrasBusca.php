<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PalavrasBusca extends Model
{
    use HasFactory;

    protected $table = 'palavras_chaves_busca';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_proposicao',
        'palavra',
    ];

    public function proposicoes(){
        return $this->hasMany(Proposicoes::class, 'id_api', 'id_proposicao');
    }
}
