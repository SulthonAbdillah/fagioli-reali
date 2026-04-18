<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Order;
use App\Services\BrevoMailService;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.catalog')
                ->with('error', 'Cart kosong');
        }

        $user = Auth::user();
        $total = 0;

        // HITUNG TOTAL
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // UPDATE STOCK
        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            if ($product) {
                $product->update([
                    'stock' => max(0, $product->stock - $item['quantity'])
                ]);
            }
        }

        /*
        |--------------------------------------------------
        | 🔥 SIMPAN KE MYSQL (INI YANG PENTING)
        |--------------------------------------------------
        */
        try {
            Order::create([
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'email'     => $user->email,
                'total'     => $total,
                'items'     => $cart,
            ]);
        } catch (\Exception $e) {
            Log::error('DB Order Error: ' . $e->getMessage());
        }

        // KIRIM EMAIL
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

        // CLEAR CART
        session()->forget('cart');

        return redirect()->route('home')
            ->with('success', 'Checkout berhasil! Invoice dikirim.');
    }
}