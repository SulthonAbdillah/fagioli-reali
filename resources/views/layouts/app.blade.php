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

<!-- 🔥 FIX UTAMA: DIRECT PATH -->
<link rel="stylesheet" href="/css/style.css?v={{ time() }}">

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>