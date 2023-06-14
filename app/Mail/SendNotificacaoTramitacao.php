<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Repositories\UserRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Parlamentar;
use App\Models\Notificacao;

class SendNotificacaoTramitacao extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $proposicao;
    protected $tramitacao;

    public function __construct($proposicao, $tramitacao)
    {
        $this->proposicao = $proposicao;
        $this->tramitacao = $tramitacao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        foreach(User::all() as $b){
            $this->subject("Tili - Nova tramitação da proposição");
            $this->to($b->email, $b->name);
            $findParlamentar = Parlamentar::where('nano_id', $this->proposicao->nano_id)->first();
            $this->markdown('mail.notificacaotramitacao', ["user" => $b->name, "proposicao" => $this->proposicao, "parlamentar" => $findParlamentar, "tramitacao" => $this->tramitacao ]);
        }

        Notificacao::create([
            "name"          => "Nova tramitação na proposição",
            "status"        => 1,
            "id_proposicao" => $this->proposicao->id_api
        ]);

        return true;
    }
}
