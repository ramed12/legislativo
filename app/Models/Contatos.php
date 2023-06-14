<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contatos extends Model
{
    use HasFactory;

    protected $table = 'contatos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nano_id',
        'tipo',
        'id_api',
        'valor',
        'observacao',
        'created_at',
        'updated_at',
    ];
}
