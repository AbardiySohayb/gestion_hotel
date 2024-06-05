<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $invoicePath;
    public $totalAmount;

    public function __construct($reservation, $invoicePath)
    {
        $this->reservation = $reservation;
        $this->invoicePath = $invoicePath;
        $this->totalAmount = session('totalAmount');
    }

    public function build()
    {
        return $this->view('emails.invoice')
                    ->with([
                        'reservationDetails' => $this->reservation->reservationDetails,
                        'totalAmount' => $this->totalAmount,
                        'startDate' => $this->reservation->date_debut,
                        'endDate' => $this->reservation->date_fin
                    ])
                    ->attach($this->invoicePath, [
                        'as' => 'invoice.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
