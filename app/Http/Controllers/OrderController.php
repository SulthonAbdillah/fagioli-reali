<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function index()
    {
        try {

            $database = app('firebase.database');

            $orders = $database
                ->getReference('orders')
                ->getValue();

            if (!$orders) {
                $orders = [];
            }

        } catch (\Exception $e) {

            // 🔥 Biar gak crash
            Log::error('Firebase Error: ' . $e->getMessage());

            $orders = [];

        }

        return view('admin.orders', compact('orders'));
    }

}