<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewReview extends Mailable
{
    use Queueable, SerializesModels;

    // Definiamo la variabile di instanza come public
    public $review;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_review)
    {
        $this->review = $_review;
    }

    /**
     * Get the message envelope.
     *
     * Questo metodo si occupa dell'oggetto del messaggio ed indirizzo di risposta (replayTo)
     * 
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            replyTo: 'noreply@boolprojects.com',
            subject: 'New Review',
        );
    }

    /**
     * Get the message content definition.
     * 
     * Questo metodo si occupa del contenuto che verrà mostrato nella e-mail tramite una view blade
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.new-review',
        );
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
