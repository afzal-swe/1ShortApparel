<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;


    public $order;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $content)
    {
        //
        $this->order = $order;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Invoice Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     // return new Content(
    //     //     view: 'frontend.mail.invoice',
    //     // );
    //     return $this->view('frontend.mail.invoice');
    // }


    public function build()
    {

        // dd($this->order, $this->content);
        return $this->view('frontend.mail.invoice')
            ->with(['text' => $this->order, 'details' => $this->content]);
    }





    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
