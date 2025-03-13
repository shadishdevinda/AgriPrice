<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLoginCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $password;

    /**
     * Create a new message instance.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Login Credentials')
                    ->view('emails.login_credentials'); // Blade template for the email
    }
}
