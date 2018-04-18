<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Seller extends Mailable
{
    use Queueable, SerializesModels;
    public $seller;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seller)
    {
        $this->seller = $seller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->view('emails.contact');
        return $this->from('example@example.com')
            ->markdown('emails.seller');
    }
}
