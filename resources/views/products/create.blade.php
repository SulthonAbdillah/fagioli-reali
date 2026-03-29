@extends('layouts.admin')

@section('content')

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-6">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="mb-4 fw-bold">

<i class="bi bi-plus-circle"></i>
Add New Product

</h3>


<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

@csrf


<div class="mb-3">

<label class="form-label">Product Name</label>

<input
type="text"
name="name"
class="form-control"
placeholder="Arabica Premium Beans"
required>

</div>


<div class="mb-3">

<label class="form-label">Price</label>

<input
type="number"
name="price"
class="form-control"
placeholder="50000"
required>

</div>


<div class="mb-3">

<label class="form-label">Stock</label>

<input
type="number"
name="stock"
class="form-control"
placeholder="100"
required>

</div>


<div class="mb-4">

<label class="form-label">Product Image</label>

<input
type="file"
name="image"
class="form-control">

</div>


<div class="d-flex justify-content-between">

<a href="/admin" class="btn btn-outline-secondary">

<i class="bi bi-arrow-left"></i> Back

</a>


<button class="btn btn-coffee">

<i class="bi bi-check-lg"></i>
Save Product

</button>

</div>


</form>

</div>

</div>

</div>

</div>

</div>

@endsection