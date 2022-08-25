<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$subject)
    {
        $this->data = $data;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = Auth::user()->email;
        
        if ($this->data['document']) {
            return $this->from($from)->subject($this->subject)->attach($this->data['document']->getRealPath(),['as' => $this->data['document']->getClientOriginalName(),'mime' => $this->data['document']->getClientMimeType(),])->view('email.email_template')->with('data',$this->data);
        } else {
            return $this->from($from)->subject($this->subject)->view('email.email_template')->with('data',$this->data);
        }
        
        
    }
}
