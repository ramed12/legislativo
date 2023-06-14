<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PalavrasChaves extends Model
{
    use HasFactory;

    protected $table = 'palavras_chaves';
    protected $primaryKey = 'id';
    protected $fillable = [
        'chave',
        'user',
        'created_at',
        'updated_at'
    ];

    public function usuario(){
        return $this->hasOne(User::class, 'id', 'user');
    }
}
