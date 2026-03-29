@extends('layouts.admin')

@section('content')

<div class="container py-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="fw-bold">
Admin Dashboard
</h2>

<div>

<a href="{{ route('admin.orders') }}" class="btn btn-dark me-2">
<i class="bi bi-receipt"></i> Orders
</a>

<a href="{{ route('products.create') }}" class="btn btn-coffee">
<i class="bi bi-plus-lg"></i> Add Product
</a>

</div>

</div>


@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif


<div class="card shadow-sm">

<div class="card-body">

<h5 class="mb-4">Product Management</h5>

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">

<tr>

<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th width="200">Actions</th>

</tr>

</thead>

<tbody>

@if(!empty($products))

@foreach($products as $id => $product)

<tr>

<td>

@if(isset($product['image']) && $product['image'])

<img src="{{ asset('storage/'.$product['image']) }}"
width="60"
class="rounded">

@else

<img src="https://via.placeholder.com/60"
class="rounded">

@endif

</td>

<td>

{{ $product['name'] ?? '-' }}

</td>

<td>

Rp {{ number_format($product['price'] ?? 0) }}

</td>

<td>

<span class="badge bg-secondary">

{{ $product['stock'] ?? 0 }}

</span>

</td>

<td>

<a href="{{ route('products.edit',$id) }}"
class="btn btn-sm btn-warning">

<i class="bi bi-pencil"></i> Edit

</a>

<form action="{{ route('products.destroy',$id) }}"
method="POST"
class="d-inline"
onsubmit="return confirm('Delete this product?')">

@csrf
@method('DELETE')

<button type="submit" class="btn btn-sm btn-danger">

<i class="bi bi-trash"></i> Delete

</button>

</form>

</td>

</tr>

@endforeach

@else

<tr>

<td colspan="5" class="text-center">

No products found

</td>

</tr>

@endif

</tbody>

</table>

</div>

</div>

</div>

</div>

@endsection