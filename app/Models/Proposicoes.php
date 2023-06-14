<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProposicoesSeguidas;
use App\Models\Parlamentar;

class Proposicoes extends Model
{
    use HasFactory;

    protected $table = 'proposicoes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_api',
        'tipo',
        'nano_id',
        'coautores',
        'ementa',
        'codigo',
        'arquivo',
        'data_leitura',
        'data_fim',
        'processo',
        'conteudo',
        'justificativa',
        'anexos',
        'url',
        'protocoloP',
        'ano_proposicao'
    ];

    public function seguidas(){
        return $this->hasOne(ProposicoesSeguidas::class, 'nano_id', 'nano_id');
    }

    public function user(){
        return $this->hasOne(Parlamentar::class, 'nano_id', 'nano_id');
    }

    public function tramitacoes(){
        return $this->hasMany(Tramitacoes::class, 'id_proposicao','id_api')->orderBy('id', 'DESC');
    }

    public function proposicoesSeguidas(){
        return $this->hasOne(ProposicoesSeguidas::class, 'id_proposicao', 'id_api');
    }

    public function anotacoes(){
        return $this->hasMany(Anotacoes::class, 'id_proposicao', 'id_api')->orderBy('id', 'DESC');
    }

    public function propSeguidas(){
        return $this->hasMany(ProposicoesSeguidas::class, 'id_proposicao', 'id_api');
    }
    public function propPalavras(){
        return $this->hasMany(PalavrasBusca::class, 'id_proposicao', 'id_api');
    }

    public function parecer(){
        return $this->hasOne(Parecer_proposicao::class, 'id_proposicao', 'id_api');
    }

    public function sendEmail($value){
        return \Mail::send(new \App\Mail\SendNotificacaoProposicoes($value));
    }
}
