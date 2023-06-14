<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Filiacoes;
use App\Models\Midias;
use App\Models\Contatos;
use App\Models\Mandatos;
use App\Models\Anotacoes;
use App\Models\Proposicoes;

class Parlamentar extends Model
{
    use HasFactory;

    protected $table = 'parlamentar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'cpf',
        'data_nascimento',
        'sexo',
        'cidade_nascimento',
        'estado',
        'nano_id',
        'fotografia',
        'status',
        'biografia',
        'perfil',
        'created_at',
        'updated_at',
    ];

    public function filiacoes(){
        return $this->hasMany(Filiacoes::class, 'nano_id', 'nano_id');
    }

    public function midias(){
        return $this->hasMany(Midias::class, 'nano_id', 'nano_id');
    }

    public function contato(){
        return $this->hasMany(Contatos::class, 'nano_id', 'nano_id');
    }

    public function mandatos(){
        return $this->hasMany(Mandatos::class, 'nano_id', 'nano_id');
    }

    public function anotacoesS(){
        return $this->hasMany(Anotacoes::class, 'nano_id', 'nano_id')->orderBy('id', 'DESC');
    }

    public function proposicoes(){
        return $this->hasMany(Proposicoes::class, 'nano_id', 'nano_id');
    }

    public function licencas(){
        return $this->hasMany(LicencaParlamentar::class, 'nano_id', 'nano_id')->orderBy('diario_oficial', 'DESC');
    }
}
