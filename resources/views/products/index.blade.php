@extends('layouts.admin')

@section('content')

<div class="container py-5">

<h2 class="mb-4">Product Management</h2>

<a href="{{ route('products.create') }}" class="btn btn-coffee mb-4">
Add Product
</a>

<div class="row">

@foreach($products as $id => $product)

<div class="col-md-4 mb-4">

<div class="card shadow-sm">

@if(isset($product['image']) && $product['image'])

<img
src="{{ asset('storage/'.$product['image']) }}"
class="card-img-top">

@else

<img
src="{{ asset('images/no-image.jpg') }}"
class="card-img-top">

@endif


<div class="card-body">

<h5>
{{ $product['name'] ?? '-' }}
</h5>

<p>
Rp {{ number_format($product['price'] ?? 0) }}
</p>

<p>
Stock: {{ $product['stock'] ?? 0 }}
</p>

<a
href="/products/{{ $id }}/edit"
class="btn btn-warning btn-sm">

Edit

</a>

<form
action="/products/{{ $id }}"
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