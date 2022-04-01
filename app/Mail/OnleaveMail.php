<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OnleaveMail extends Mailable
{
    use Queueable, SerializesModels;
    public $store;

    public function __construct($store)
    {
        $this->store = $store;
    }

    public function build()
    {
        return $this->view('mail.onleave')->subject('Xin nghỉ phép');
    }
}
