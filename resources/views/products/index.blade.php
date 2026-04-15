@extends('layouts.admin')

@section('content')

<div class="container py-5">

<h2 class="mb-4">Product Management</h2>

<a href="{{ route('products.create') }}" class="btn btn-coffee mb-4">
Add Product
</a>

<div class="row">

@foreach($products as $product)

<div class="col-md-4 mb-4">

<div class="card shadow-sm">

<td>
    @if($product->image)
        <img src="{{ $product->image }}" width="80" height="80" style="object-fit: cover; border-radius: 8px;">
    @else
        <img src="{{ asset('images/no-image.jpg') }}" width="80">
    @endif
</td>

<div class="card-body">

<h5>
{{ $product->name }}
</h5>

<p>
Rp {{ number_format($product->price) }}
</p>

<p>
Stock: {{ $product->stock }}
</p>

<a
href="/products/{{ $product->id }}/edit"
class="btn btn-warning btn-sm">

Edit

</a>

<form
action="/products/{{ $product->id }}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
Delete
</button>

</form>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection