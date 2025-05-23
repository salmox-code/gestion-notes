<?php

namespace App\Mail;

use App\Models\Convocation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConvocationEnvoyee extends Mailable
{
    use Queueable, SerializesModels;

    public $convocation;

    public function __construct(Convocation $convocation)
    {
        $this->convocation = $convocation;
    }

    /**
     * Sujet de l'email
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📅 Convocation à la surveillance',
        );
    }

    /**
     * Vue markdown utilisée pour l'email
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.convocation',
        );
    }

    /**
     * Si pièces jointes (non utilisé ici)
     */
    public function attachments(): array
    {
        return [];
    }
}
