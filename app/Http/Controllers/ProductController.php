<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | ADMIN PRODUCT LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $database = app('firebase.database');

        $products = $database
            ->getReference('products')
            ->getValue() ?? [];

        return view('products.index', compact('products'));
    }


    /*
    |--------------------------------------------------------------------------
    | USER PRODUCT CATALOG
    |--------------------------------------------------------------------------
    */

    public function catalog()
    {
        $database = app('firebase.database');

        $products = $database
            ->getReference('products')
            ->getValue() ?? [];

        return view('shop.products', compact('products'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE PRODUCT PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('products.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $database = app('firebase.database');

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

            $imagePath = $file->storeAs('products', $filename, 'public');
        }

        $database->getReference('products')->push([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return redirect('/admin')->with('success', 'Product created successfully');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PRODUCT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $database = app('firebase.database');

        $product = $database
            ->getReference('products/' . $id)
            ->getValue();

        return view('products.edit', compact('product', 'id'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $database = app('firebase.database');

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description
        ];

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

            $imagePath = $file->storeAs('products', $filename, 'public');

            $updateData['image'] = $imagePath;
        }

        $database
            ->getReference('products/' . $id)
            ->update($updateData);

        return redirect('/admin')->with('success', 'Product updated successfully');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $database = app('firebase.database');

        $database
            ->getReference('products/' . $id)
            ->remove();

        return redirect('/admin')->with('success', 'Product deleted successfully');
    }

}