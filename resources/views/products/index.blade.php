@extends('layouts.admin')

@section('content')

<div class="container py-5">

<h2 class="mb-4">Product Management</h2>

<a href="{{ route('products.create') }}" class="btn btn-coffee mb-4">
Add Product
</a>

<div class="table-responsive">

<table class="table table-bordered align-middle text-center">

<thead class="table-dark">
<tr>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Actions</th>
</tr>
</thead>

<tbody>

@foreach($products as $product)

<tr>

<td>
@if($product->image)
<img 
    src="{{ $product->image }}" 
    width="80" 
    height="80"
    style="object-fit: cover; border-radius: 8px;">
@else
<img 
    src="{{ asset('images/no-image.jpg') }}" 
    width="80">
@endif
</td>

<td>{{ $product->name }}</td>

<td>Rp {{ number_format($product->price) }}</td>

<td>
<span class="badge bg-secondary">
{{ $product->stock }}
</span>
</td>

<td>
<a href="/products/{{ $product->id }}/edit" class="btn btn-warning btn-sm">
Edit
</a>

<form action="/products/{{ $product->id }}" method="POST" class="d-inline">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm">
Delete
</button>
</form>
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection