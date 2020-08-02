<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class veriify extends Mailable
{
    use Queueable, SerializesModels;
    public $tokken,$name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Name,$tokken)
    {
        //take name and tokken
        $this->name=$Name;
        $this->tokken=$tokken;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email/verify');
    }
}
