<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }

        // ✅ Ambil dari MySQL
        $products = Product::all();

        return view('admin.dashboard', compact('products'));
    }
}