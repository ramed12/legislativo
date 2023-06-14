<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    use HasFactory;

    protected $table = 'notificacao';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'status',
        'id_proposicao'
    ];
}
