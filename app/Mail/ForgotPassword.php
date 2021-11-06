<?php

namespace App\Mail;

use Illuminate\Support\Str;
use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->token = new PasswordReset;
        $this->token->token = Str::random(32);
        $this->token->email = $user->email;
        $this->token->save();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = URL::to('/') . "/new-password/" . $this->token . "/" . $this->user->email;
        return $this->subject("Demande de réinitialisation de mot de passe")
            ->markdown("emails.forgot-password")
            ->with([
                "user" => $this->user,
                "url" => $url
            ]);
    }
}
