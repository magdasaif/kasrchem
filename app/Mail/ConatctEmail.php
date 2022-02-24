<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConatctEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $dd;
    public $maill;
    public function __construct($data)
    {
        $this->dd=$data;
        $this->maill=$data['mail'];

    }

    public function build()
    {
        return $this->from($this->maill)
                    ->view('emails.contact');
    }
}
