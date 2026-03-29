<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderInvoice;

class CheckoutController extends Controller
{

    public function checkout(Request $request)
    {

        $database = app('firebase.database');

        $cart = session()->get('cart', []);

        /*
        |--------------------------------------------------------------------------
        | CEK CART
        |--------------------------------------------------------------------------
        */

        if (empty($cart)) {

            return redirect()->route('products.catalog')
                ->with('error', 'Cart kosong');

        }

        $user = Auth::user();

        $total = 0;

        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL HARGA
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $item) {

            if (isset($item['price']) && isset($item['quantity'])) {

                $total += $item['price'] * $item['quantity'];

            }

        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE STOCK PRODUK
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $id => $item) {

            $product = $database
                ->getReference('products/' . $id)
                ->getValue();

            if ($product && isset($product['stock'])) {

                $newStock = $product['stock'] - $item['quantity'];

                if ($newStock < 0) {
                    $newStock = 0;
                }

                $database
                    ->getReference('products/' . $id)
                    ->update([
                        'stock' => $newStock
                    ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN ORDER KE FIREBASE
        |--------------------------------------------------------------------------
        */

        $orderData = [

            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'items' => $cart,
            'total' => $total,
            'date' => now()->toDateTimeString()

        ];

        $database
            ->getReference('orders')
            ->push($orderData);

        /*
        |--------------------------------------------------------------------------
        | KIRIM EMAIL INVOICE
        |--------------------------------------------------------------------------
        */

        Mail::to($user->email)->send(
            new OrderInvoice($cart, $total)
        );

        /*
        |--------------------------------------------------------------------------
        | HAPUS CART
        |--------------------------------------------------------------------------
        */

        session()->forget('cart');

        /*
        |--------------------------------------------------------------------------
        | REDIRECT KE HOME
        |--------------------------------------------------------------------------
        */

        return redirect()->route('home')
            ->with('success', 'Checkout berhasil! Invoice telah dikirim ke email.');

    }

}