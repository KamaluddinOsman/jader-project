<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    private $code;
    private $first_name;
    private $last_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code,$first_name,$last_name)
    {
        $this->code = $code;
        $this->first_name = $first_name;
        $this->last_name  = $last_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.reset',['code' => $this->code,'name' => $this->first_name .'' . $this->last_name]);
    }
}
