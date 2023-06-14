<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parecer_proposicao extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'parecer_proposicao';

    protected $fillable = [
        'id_parecer',
        'id_proposicao',
        'texto',
        'id_user'
    ];

    public function usuarioParecer(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function parecerCadastrado(){
        return $this->hasOne(Parecer::class, 'id', 'id_parecer');
    }
}
