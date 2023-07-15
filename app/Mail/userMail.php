<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->name = $name;
        $this->message ="<b>Hello message</b>";
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mail@example.com', 'Mailtrap')
            ->subject('Mailtrap Confirmation')
            ->markdown('mail.admin_forgot_password')
            ->with([
                'name' => 'New Mailtrap User',
                'link' => '/contact/',
                'message' =>$this->message 
            ]);
        // return $this->from('info@alifbaonline.com')
        //         ->view('mail.test');
    }
}
