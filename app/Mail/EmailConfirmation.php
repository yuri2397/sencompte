<?php

namespace App\Mail;

use Illuminate\Support\Str;
use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $client;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->token = new PasswordReset;
        $this->token->token = Str::random(32);
        $this->token->email = $client->email;
        $this->token->save();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = URL::to('/') . '/client/confirmation/' . $this->token->token . '/' . $this->client->email;
        return $this->subject('Valider votre addresse mail sur Senecompte')
            ->markdown('emails.client.confirm-email', [
                'client' => $this->client,
                'token' => $this->token,
                'url' => $url
            ]);
    }
}
