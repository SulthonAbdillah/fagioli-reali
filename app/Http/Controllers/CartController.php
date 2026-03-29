<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

    // SHOP PAGE
    public function shop()
    {
        $database = app('firebase.database');

        $products = $database
            ->getReference('products')
            ->getValue() ?? [];

        return view('shop.index', compact('products'));
    }


    // ADD TO CART
    public function addToCart($id)
    {
        $database = app('firebase.database');

        $product = $database
            ->getReference('products/' . $id)
            ->getValue();

        if(!$product){
            return redirect()->back();
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [
                "name" => $product['name'],
                "price" => $product['price'],
                "image" => $product['image'] ?? null,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }


    // CART PAGE (optional)
    public function cart()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }


    // REMOVE ITEM
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

}