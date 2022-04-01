<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponseOnleaveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $update;

    public function __construct($update)
    {
        $this->update = $update;
    }

    public function build()
    {
        return $this->view('mail.responseOnleave')->subject('RE: xin nghỉ phép');
    }
}
