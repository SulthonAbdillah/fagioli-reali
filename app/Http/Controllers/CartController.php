<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{

    // SHOP PAGE
    public function shop()
    {
        $products = Product::all();

        return view('shop.index', compact('products'));
    }


    // ADD TO CART
    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product){
            return redirect()->back();
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }


    // CART PAGE
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