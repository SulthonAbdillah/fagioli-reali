<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Cloudinary\Cloudinary;

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

        $imageUrl = null;

        // 🔥 INIT CLOUDINARY DI SINI (BUKAN DI CONSTRUCTOR)
        if ($request->hasFile('image')) {

            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name'),
                    'api_key'    => config('cloudinary.api_key'),
                    'api_secret' => config('cloudinary.api_secret'),
                ],
            ]);

            $upload = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath()
            );

            $imageUrl = $upload['secure_url'];
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $imageUrl
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

            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name'),
                    'api_key'    => config('cloudinary.api_key'),
                    'api_secret' => config('cloudinary.api_secret'),
                ],
            ]);

            $upload = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath()
            );

            $data['image'] = $upload['secure_url'];
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