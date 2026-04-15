<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function catalog()
    {
        $products = Product::all();
        return view('shop.products', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

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

            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // 🔥 SIMPAN KE PUBLIC LANGSUNG
            $file->move(public_path('products'), $filename);

            $imagePath = 'products/' . $filename;
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

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

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

            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('products'), $filename);

            $data['image'] = 'products/' . $filename;
        }

        $product->update($data);

        return redirect('/admin')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/admin')->with('success', 'Product deleted successfully');
    }
}