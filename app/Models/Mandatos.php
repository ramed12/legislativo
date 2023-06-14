<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mandatos extends Model
{
    use HasFactory;

    protected $table = 'mandatos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'nano_id',
        'inicio',
        'id_api',
        'fim',
        'diploma',
        'votos',
        'legislatura',
        'coligacao',
        'created_at',
        'updated_at',
    ];
}
