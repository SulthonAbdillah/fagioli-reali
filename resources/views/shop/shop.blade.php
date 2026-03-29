@extends('layouts.app')

@section('content')

<section class="section product-section">

<div class="container">

<h2 class="section-title">
Our <span>Coffee</span>
</h2>

<div class="row g-4">

@foreach($products as $product)

<div class="col-lg-4 col-md-6">

<div class="product-card">

<div class="product-img">

<img src="{{ asset('storage/'.$product->image) }}">

</div>

<div class="card-body">

<h5 class="product-name">
{{ $product->name }}
</h5>

<p class="price">
Rp {{ number_format($product->price) }}
</p>

<form action="{{ route('cart.add',$product->id) }}" method="POST">

@csrf

<button class="btn btn-coffee w-100">
Tambah ke Keranjang
</button>

</form>

</div>

</div>

</div>

@endforeach

</div>

</div>

</section>

@endsection