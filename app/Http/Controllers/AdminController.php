<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function dashboard()
    {

        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }

        $database = app('firebase.database');

        $products = $database
            ->getReference('products')
            ->getValue() ?? [];

        $orders = $database
            ->getReference('orders')
            ->getValue() ?? [];

        return view('admin.dashboard', compact('products','orders'));

    }

}