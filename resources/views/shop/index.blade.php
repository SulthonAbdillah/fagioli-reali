@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
Fagioli Reali Coffee Store
</h1>

<a href="/cart" class="bg-black text-white px-4 py-2 rounded">
Lihat Keranjang
</a>

<hr class="my-6">

@if(!empty($products))

<div class="grid grid-cols-3 gap-6">

@foreach($products as $id => $product)

<div class="bg-white shadow rounded-lg p-4">

<h3 class="text-lg font-semibold">
{{ $product['name'] }}
</h3>

<p class="text-gray-600">
Harga: Rp {{ $product['price'] }}
</p>

<p class="text-gray-600 mb-3">
Stock: {{ $product['stock'] }}
</p>

@if(isset($product['image']))

<img src="{{ asset('storage/'.$product['image']) }}"
class="w-full h-40 object-cover rounded mb-3">

@endif

<form action="/cart/add/{{ $id }}" method="POST">

@csrf

<button
class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded w-full">
Tambah ke Keranjang
</button>

</form>

</div>

@endforeach

</div>

@else

<p>Tidak ada produk</p>

@endif

@endsection