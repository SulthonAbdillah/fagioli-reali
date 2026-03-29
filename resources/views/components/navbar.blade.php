<nav class="navbar navbar-expand-lg navbar-custom">

<div class="container">

<a class="navbar-brand" href="{{ route('home') }}">
Fagioli<span style="color:#c8a27c">Reali.</span>
</a>

@auth

<button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse justify-content-center" id="navbarNav">

<div class="navbar-menu">

<a href="{{ route('home') }}">Home</a>
<a href="{{ route('about') }}">About Us</a>
<a href="{{ route('products.catalog') }}">Products</a>
<a href="{{ route('contact') }}">Contact</a>

</div>

</div>

<div class="d-flex align-items-center">

{{-- CART ICON WITH SIDEBAR --}}
<a class="text-white me-4 position-relative" data-bs-toggle="offcanvas" href="#cartSidebar">

<i class="bi bi-cart" style="font-size:20px"></i>

<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

{{ count(session('cart',[])) }}

</span>

</a>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button class="btn btn-coffee">Logout</button>
</form>

</div>

@endauth


@guest

<a href="{{ route('login') }}" class="btn btn-coffee">
Login
</a>

@endguest

</div>

</nav>