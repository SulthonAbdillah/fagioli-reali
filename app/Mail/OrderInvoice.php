<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OrderInvoice extends Mailable
{
    public $cart;
    public $total;

    public function __construct($cart, $total)
    {
        $this->cart = $cart;
        $this->total = $total;
    }

    public function build()
    {
        return $this->subject('Fagioli Reali Coffee - Order Invoice')
                    ->view('emails.invoice');
    }
}