<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anotacoes extends Model
{
    use HasFactory;

    protected $table = 'anotacoes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user',
        'titulo',
        'texto',
        'nano_id',
        'id_proposicao',
        'arquivo',
        'created_at',
        'updated_at'
    ];

    public function usuario(){
        return $this->hasOne(User::class, 'id', 'user');
    }
}
