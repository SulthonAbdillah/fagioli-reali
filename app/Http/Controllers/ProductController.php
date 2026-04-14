<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    // ===============================
    // ADMIN PRODUCT LIST
    // ===============================
    public function index()
    {
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
    }

    // ===============================
    // USER PRODUCT CATALOG
    // ===============================
    public function catalog()
    {
        $products = Product::all();

        return view('shop.products', compact('products'));
    }

    // ===============================
    // CREATE PAGE
    // ===============================
    public function create()
    {
        return view('products.create');
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
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

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return redirect('/admin')->with('success', 'Product created successfully');
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('products', $filename, 'public');
        }

        $product->update($data);

        return redirect('/admin')->with('success', 'Product updated successfully');
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('/admin')->with('success', 'Product deleted successfully');
    }
}