<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $rejected;
     public function __construct($rejected)
     {
         $this->rejected = $rejected;
     }

     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
       return $this->from('sender@example.com')
                   ->subject('Akun anda belum terverifikasi')
                   ->view('mails.rejected');
     }
}
