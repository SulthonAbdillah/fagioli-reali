<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderInvoice;
use App\Models\Product;

class CheckoutController extends Controller
{

    public function checkout(Request $request)
    {
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
        | HITUNG TOTAL
        |--------------------------------------------------------------------------
        */
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE STOCK (MYSQL)
        |--------------------------------------------------------------------------
        */
        foreach ($cart as $id => $item) {

            $product = Product::find($id);

            if ($product) {

                $newStock = $product->stock - $item['quantity'];

                if ($newStock < 0) {
                    $newStock = 0;
                }

                $product->update([
                    'stock' => $newStock
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | KIRIM EMAIL
        |--------------------------------------------------------------------------
        */
        Mail::to($user->email)->send(
            new OrderInvoice($cart, $total)
        );

        /*
        |--------------------------------------------------------------------------
        | CLEAR CART
        |--------------------------------------------------------------------------
        */
        session()->forget('cart');

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */
        return redirect()->route('home')
            ->with('success', 'Checkout berhasil! Invoice telah dikirim ke email.');
    }

}