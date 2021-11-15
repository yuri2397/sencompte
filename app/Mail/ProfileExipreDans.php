<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfileExipreDans extends Mailable
{
    use Queueable, SerializesModels;
    public $profile;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Ne pas reprondre")
            ->markdown('emails.client.profile-expire-dans', [
                "client" => $this->profile->client,
                "profile" => $this->profile
            ]);
    }
}
