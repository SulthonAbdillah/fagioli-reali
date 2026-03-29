@extends('layouts.app')

@section('content')

<div class="container py-5">

<h2 class="text-center mb-5">Our Coffee Products</h2>

<div class="row">

@foreach($products as $key => $product)

<div class="col-md-4 mb-4">

<div class="card h-100 shadow-sm">

@if(isset($product['image']) && $product['image'] != '')

<img src="{{ asset('storage/'.$product['image']) }}" class="card-img-top">

@else

<img src="{{ asset('images/no-image.jpg') }}" class="card-img-top">

@endif

<div class="card-body text-center">

<h5 class="card-title">
{{ $product['name'] ?? 'Coffee Product' }}
</h5>

<p class="card-text">
{{ $product['description'] ?? '' }}
</p>

<p class="mb-1">
<strong>Price:</strong> Rp {{ number_format($product['price'] ?? 0) }}
</p>

<p class="mb-3">
<strong>Stock:</strong> {{ $product['stock'] ?? 0 }}
</p>

<form action="{{ route('cart.add',$key) }}" method="POST">

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