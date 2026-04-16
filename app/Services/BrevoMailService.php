<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrevoMailService
{
    public function sendInvoice($toEmail, $toName, $cart, $total)
    {
        $apiKey = env('BREVO_API_KEY');

        $htmlContent = view('emails.invoice', compact('cart', 'total'))->render();

        $response = Http::withHeaders([
            'api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => 'Fagioli Reali Coffee',
                'email' => 'sulthonabdillah32@gmail.com'
            ],
            'to' => [
                [
                    'email' => $toEmail,
                    'name' => $toName
                ]
            ],
            'subject' => 'Invoice Order Fagioli Reali',
            'htmlContent' => $htmlContent
        ]);

        return $response->json();
    }
}