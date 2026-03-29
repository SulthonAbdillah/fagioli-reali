<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Fagioli Reali Coffee</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

@include('components.navbar')

<main>
@yield('content')
</main>

<footer class="footer mt-5">

<div class="container text-center">

<p class="mb-0">
© {{ date('Y') }} Fagioli Reali Coffee
</p>

</div>

</footer>


{{-- CART SIDEBAR --}}

<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar">

<div class="offcanvas-header">

<h5 class="offcanvas-title">Your Cart</h5>

<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>

</div>

<div class="offcanvas-body">

@php
$cart = session('cart', []);
$total = 0;
@endphp


@forelse($cart as $id => $item)

<div class="d-flex mb-3 align-items-center">

@if($item['image'])

<img src="{{ asset('storage/'.$item['image']) }}" width="60">

@else

<img src="{{ asset('images/no-image.jpg') }}" width="60">

@endif

<div class="ms-3">

<strong>{{ $item['name'] }}</strong>

<br>

Qty: {{ $item['quantity'] }}

<br>

Rp {{ number_format($item['price']) }}

</div>

</div>

@php
$total += $item['price'] * $item['quantity'];
@endphp

<form action="{{ route('cart.remove',$id) }}" method="POST">

@csrf

<button class="btn btn-sm btn-danger mb-3">
Remove
</button>

</form>

@empty

<p>Cart is empty</p>

@endforelse


<hr>

<h5>Total: Rp {{ number_format($total) }}</h5>

<form action="{{ route('checkout') }}" method="POST">

@csrf

<button class="btn btn-dark w-100 mt-3">
Checkout
</button>

</form>

</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>