<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cloudinary\Cloudinary;

class ProductController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
    }

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

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $upload = $this->cloudinary->uploadApi()->upload(
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
            $upload = $this->cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath()
            );

            $data['image'] = $upload['secure_url'];
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