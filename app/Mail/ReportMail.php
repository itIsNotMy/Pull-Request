<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reoprt;
    
    public function __construct($reoprt)
    {
        $this->reoprt = $reoprt;
    }

    public function build()
    {
        return $this->markdown('mail.reoprt');
    }
}
