@extends('layouts.app')

@section('content')

<style>

.hero{
height:100vh;
background-image:url('{{ asset('images/coffee-hero.jpg') }}');
background-size:cover;
background-position:center;
background-repeat:no-repeat;
display:flex;
align-items:center;
}

.hero-overlay{
width:100%;
height:100%;
background:rgba(0,0,0,0.45);
display:flex;
align-items:center;
}

.hero-text{
color:white;
max-width:600px;
}

.hero-text h1{
font-size:56px;
font-weight:700;
line-height:1.2;
}

.hero-text span{
color:#c49a6c;
}

.hero-text p{
margin-top:20px;
font-size:18px;
line-height:1.6;
}

.btn-coffee{
background:#c49a6c;
color:white;
padding:12px 30px;
border:none;
}

.btn-coffee:hover{
background:#a67c52;
color:white;
}

</style>


<section class="hero">

<div class="hero-overlay">

<div class="container">

<div class="hero-text">

<h1>Savor the Coffee<br>of <span>King</span></h1>

<p>
At Fagioli Reali, we believe every cup of coffee should be a majestic
experience. With every sip, savor the richness and elegance that
define the coffee of kings.
</p>

<a href="/products-list" class="btn btn-coffee mt-3">Explore Coffee</a>

</div>

</div>

</div>

</section>

@endsection