<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProposicoesSeguidas extends Model
{
    use HasFactory;

    protected $table = 'proposicoes_seguidas';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'id_proposicao',
        'nano_id',
        'user',
        'created_at',
        'updated_at',
    ];

    public function userSeguido(){
        return $this->hasOne(User::class, 'id', 'user');
    }

    public function proposicoes(){
        return $this->hasMany(Proposicoes::class, 'id_api', 'id_proposicao');
    }



}
