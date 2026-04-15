@extends('layouts.admin')

@section('content')

<div class="container py-5">

<h2 class="mb-4">Edit Product</h2>

@if(!$product)

<div class="alert alert-danger">
Product not found
</div>

@else

<form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label class="form-label">Product Name</label>

<input
type="text"
name="name"
class="form-control"
value="{{ $product->name }}"
required>

</div>

<div class="mb-3">

<label class="form-label">Price</label>

<input
type="number"
name="price"
class="form-control"
value="{{ $product->price }}"
required>

</div>

<div class="mb-3">

<label class="form-label">Stock</label>

<input
type="number"
name="stock"
class="form-control"
value="{{ $product->stock }}"
required>

</div>

<div class="mb-3">

<label class="form-label">Product Image</label>

<input
type="file"
name="image"
class="form-control">

</div>

@if($product->image)

<img
src="{{ asset($product->image) }}"
width="120"
class="mb-3">

@endif

<button class="btn btn-coffee">
Update Product
</button>

<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
Back
</a>

</form>

@endif

</div>

@endsection