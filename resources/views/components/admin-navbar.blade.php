<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
Fagioli<span style="color:#c8a27c">Reali.</span>
</a>

<div class="d-flex align-items-center">

<span class="text-white me-3">

Admin Panel

</span>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button class="btn btn-coffee">
Logout
</button>
</form>

</div>

</div>

</nav>