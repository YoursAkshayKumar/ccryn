<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        //
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reset_link = $this->request['reset_link'];
        $full_name = $this->request['full_name'];
        $subject = "Reset Password Notification";

        return $this->view('mails.reset-password-mail')
                    ->subject($subject)
                    ->with([
                        'reset_link' => $reset_link,
                        'full_name' => $full_name
                    ]);
    }
}
