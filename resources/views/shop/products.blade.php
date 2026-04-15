@extends('layouts.app')

@section('content')

<div class="container py-5">

<h2 class="text-center mb-5">Our Coffee Products</h2>

<div class="row">

@foreach($products as $product)

<div class="col-md-4 mb-4">

<div class="card h-100 shadow-sm border-0">

@if($product->image)
<img 
    src="{{ $product->image }}" 
    class="card-img-top"
    style="height: 250px; object-fit: cover;">
@else
<img 
    src="{{ asset('images/no-image.jpg') }}" 
    class="card-img-top"
    style="height: 250px; object-fit: cover;">
@endif

<div class="card-body text-center">

<h5 class="card-title fw-bold">
{{ $product->name }}
</h5>

<p class="card-text text-muted">
{{ $product->description ?? 'No description available' }}
</p>

<p class="mb-1">
<strong>Price:</strong> Rp {{ number_format($product->price) }}
</p>

<p class="mb-3">
<strong>Stock:</strong> {{ $product->stock }}
</p>

<form action="{{ route('cart.add',$product->id) }}" method="POST">
@csrf
<button class="btn btn-dark w-100">
<i class="bi bi-cart"></i> Add to Cart
</button>
</form>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection