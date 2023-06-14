<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parecer extends Model
{
    use HasFactory;

    protected $table = 'parecer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
        'user',
        'color',
        'created_at',
        'updated_at',
    ];

    public function usuario(){
        return $this->hasOne(User::class,'id','user');
    }
}
