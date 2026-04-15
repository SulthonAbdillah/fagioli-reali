@extends('layouts.app')

@section('content')

<div class="container py-5">

<h2 class="text-center mb-5">Our Coffee Products</h2>

<div class="row">

@foreach($products as $product)

<div class="col-md-4 mb-4">

<div class="card h-100 shadow-sm">

<td>
    @if($product->image)
        <img src="{{ $product->image }}" width="80" height="80" style="object-fit: cover; border-radius: 8px;">
    @else
        <img src="{{ asset('images/no-image.jpg') }}" width="80">
    @endif
</td>

<div class="card-body text-center">

<h5 class="card-title">
{{ $product->name }}
</h5>

<p class="card-text">
{{ $product->description }}
</p>

<p class="mb-1">
<strong>Price:</strong> Rp {{ number_format($product->price) }}
</p>

<p class="mb-3">
<strong>Stock:</strong> {{ $product->stock }}
</p>

<form action="{{ route('cart.add',$product->id) }}" method="POST">

@csrf

<button class="btn btn-dark">
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