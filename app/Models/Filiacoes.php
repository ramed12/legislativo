<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiacoes extends Model
{
    use HasFactory;

    protected $table = 'filiacoes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_api',
        'nano_id',
        'inicio',
        'fim',
        'partido',
    ];

}
