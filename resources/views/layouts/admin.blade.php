<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin - Fagioli Reali</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

body{
background:#f5f5f5;
}

.admin-navbar{
background:#1e1e1e;
}

.admin-navbar .navbar-brand{
font-weight:700;
letter-spacing:1px;
}

.btn-coffee{
background:#6b4f3b;
color:white;
border:none;
}

.btn-coffee:hover{
background:#543d2e;
color:white;
}

.card{
border:none;
border-radius:12px;
}

</style>

</head>
<body>


<nav class="navbar navbar-dark admin-navbar px-4">

<a class="navbar-brand text-white" href="/admin">
Fagioli Reali Admin
</a>

<form action="{{ route('logout') }}" method="POST">

@csrf

<button class="btn btn-outline-light btn-sm">
<i class="bi bi-box-arrow-right"></i> Logout
</button>

</form>

</nav>


<div class="container-fluid">

@yield('content')

</div>


</body>
</html>