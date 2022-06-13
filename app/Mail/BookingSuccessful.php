<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $body = "";
    public $title;

    public function __construct($body,$title)
    {
        $this->body = (string) $body;
        $this->title = $title;
    }

    public function build()
    {
        return $this->subject($this->title)->view('mail.notify');
    }
}
