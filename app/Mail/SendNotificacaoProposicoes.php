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

class SendNotificacaoProposicoes extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        foreach(User::all() as $b){

            // dd($this->details);
            $this->subject("Tili - Nova proposição");
            $this->to($b->email, $b->name);
            $findParlamentar = Parlamentar::where('nano_id', $this->details['nano_id'])->first();
            $this->markdown('mail.notificacaoProposicao', ["user" => $b->name, "proposicao" => $this->details, "parlamentar" => $findParlamentar ]);
        }

        Notificacao::create([
            "name"          => "Nova Proposição",
            "status"        => 1,
            "id_proposicao" => $this->details['id_api']
        ]);


        return true;
    }
}
