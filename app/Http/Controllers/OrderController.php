<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{

    public function index()
    {

        $database = app('firebase.database');

        $orders = $database
            ->getReference('orders')
            ->getValue();

        if(!$orders){
            $orders = [];
        }

        return view('admin.orders', compact('orders'));

    }

}