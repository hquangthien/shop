<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function build()
    {
        return $this->from('hquangthien1@gmail.com', 'E Shopper')
            ->subject($this->email['subject'])
            ->markdown('emails.notifications.notifications')->with('email', $this->email)->with('title', $this->email['subject']);
    }
}
