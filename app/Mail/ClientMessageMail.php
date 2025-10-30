<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientMessageMail extends Mailable
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
        $subject = "New Message Notification";

        return $this->view('mails.message-to-client-mail')
                ->subject($subject)
                ->with([
                        'clientData' => $this->request['customerData'], 
                        'msg' => $this->request['message'],
                    ]);
    }
}
