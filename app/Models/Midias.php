<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Midias extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'midias_sociais';
    protected $fillable = [
        'midias',
        'nano_id'
    ];
}
