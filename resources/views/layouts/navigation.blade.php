<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

<div class="container">

<!-- LOGO -->
<a class="navbar-brand fw-bold text-warning" href="/shop">
☕ Fagioli Reali
</a>

<!-- TOGGLE MOBILE -->
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">

<!-- MENU -->
<ul class="navbar-nav me-auto">

@if(Auth::user()->role === 'admin')

<li class="nav-item">
<a class="nav-link text-light" href="/admin">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link text-light" href="/products">Products</a>
</li>

@else

<li class="nav-item">
<a class="nav-link text-light" href="/shop">Home</a>
</li>

<li class="nav-item">
<a class="nav-link text-light" href="/about">About</a>
</li>

<li class="nav-item">
<a class="nav-link text-light" href="/products-list">Products</a>
</li>

<li class="nav-item">
<a class="nav-link text-light" href="/cart">Cart</a>
</li>

<li class="nav-item">
<a class="nav-link text-light" href="/contact">Contact</a>
</li>

@endif

</ul>

<!-- USER -->
<div class="d-flex align-items-center">

<span class="text-light me-3">
{{ Auth::user()->name }}
</span>

<a href="{{ route('profile.edit') }}" class="btn btn-outline-light btn-sm me-2">
Profile
</a>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="btn btn-warning btn-sm">
Logout
</button>
</form>

</div>

</div>

</div>

</nav>