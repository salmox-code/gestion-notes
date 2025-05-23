<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class ConvocationSurveillantMail extends Mailable
{
    use Queueable, SerializesModels;

    public $convocation;

    public function __construct($convocation)
    {
        $this->convocation = $convocation;
    }

    public function build()
    {
        // Générer le PDF à partir de la vue 'convocations.pdf'
        $pdf = Pdf::loadView('convocations.pdf', [
            'convocation' => $this->convocation
        ]);

        return $this->subject('📅 Votre convocation à la surveillance')
                    ->markdown('emails.surveillant.message')
                    ->attachData($pdf->output(), 'convocation.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
