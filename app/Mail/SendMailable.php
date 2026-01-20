<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $body;
    public $attach;
    public $view;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body, $attach, $view, $subject)
    {
        // if(str($view)->contains('reject')){
        //     $this->body = $body;
        // }else{
        //     $this->body = '';
        // }
        $this->body = $body;
         
         $this->attach = $attach;
         $this->view = $view;
         $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	// var_dump($this->view);
    	//echo(json_encode($this->view('TETETETET')));
        $email = $this->view('email.'.$this->view)->subject($this->subject);

        if(!empty($this->attach[0])){
            foreach($this->attach as $filePath){
                $email->attach($filePath);
            }
        }

        return $email;
    }
}
