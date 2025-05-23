<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulletinEtudiantMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $etudiant;

    public function __construct($pdf, $etudiant)
    {
        $this->pdf = $pdf;
        $this->etudiant = $etudiant;
    }

    public function build()
    {
        return $this->subject('Votre Bulletin ENSAH')
                    ->view('emails.bulletin')
                    ->with([
                        'etudiant' => $this->etudiant,
                    ])
                    ->attachData(
                        $this->pdf->output(),
                        'bulletin.pdf',
                        ['mime' => 'application/pdf']
                    );
    }
}
