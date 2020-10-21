<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $user;
    private string $email;
    private string $message;

    /**
     * Create a new message instance.
     *
     * @param string $user
     * @param string $email
     * @param string $message
     */
    public function __construct(string $user, string $email, string $message)
    {
        $this->user = $user;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('noreply@' . env('APP_NAME') . '.com')
            ->view('emails.contact');
    }
}
