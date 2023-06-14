<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicencaParlamentar extends Model
{
    use HasFactory;

    protected $table = 'licenca_parlamentar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nano_id',
        'id_api',
        'diario_oficial',
        'motivo',
        'apresentacao',
        'concessao',
        'observacao'
    ];
}
