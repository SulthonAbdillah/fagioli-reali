<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Services\BrevoMailService;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        /*
        |------------------------------------------------------------------
        | CEK CART
        |------------------------------------------------------------------
        */
        if (empty($cart)) {
            return redirect()->route('products.catalog')
                ->with('error', 'Cart kosong');
        }

        $user = Auth::user();
        $total = 0;

        /*
        |------------------------------------------------------------------
        | HITUNG TOTAL
        |------------------------------------------------------------------
        */
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        /*
        |------------------------------------------------------------------
        | UPDATE STOCK
        |------------------------------------------------------------------
        */
        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            if ($product) {
                $newStock = max(0, $product->stock - $item['quantity']);

                $product->update([
                    'stock' => $newStock
                ]);
            }
        }

        /*
        |------------------------------------------------------------------
        | SIMPAN ORDER KE FIREBASE
        |------------------------------------------------------------------
        */
        try {
            $database = app('firebase.database');

            $database->getReference('orders')->push([
                'user_name' => $user->name,
                'email' => $user->email,
                'items' => $cart,
                'total' => $total,
                'created_at' => now()->toDateTimeString()
            ]);

        } catch (\Exception $e) {
            // tidak menggagalkan checkout
            Log::error('Firebase Error: ' . $e->getMessage());
        }

        /*
        |------------------------------------------------------------------
        | KIRIM EMAIL (BREVO API)
        |------------------------------------------------------------------
        */
        try {
            $brevo = new BrevoMailService();
            $brevo->sendInvoice(
                $user->email,
                $user->name,
                $cart,
                $total
            );
        } catch (\Exception $e) {
            Log::error('Email Error: ' . $e->getMessage());

            return redirect()->route('home')
                ->with('error', 'Checkout berhasil, tapi email gagal dikirim');
        }

        /*
        |------------------------------------------------------------------
        | CLEAR CART
        |------------------------------------------------------------------
        */
        session()->forget('cart');

        /*
        |------------------------------------------------------------------
        | REDIRECT
        |------------------------------------------------------------------
        */
        return redirect()->route('home')
            ->with('success', 'Checkout berhasil! Invoice dikirim.');
    }
}