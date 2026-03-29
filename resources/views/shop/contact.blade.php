@extends('layouts.app')

@section('content')

<section class="section">

<div class="container">

<h2 class="section-title">Contact <span>Us</span></h2>

<p class="section-subtitle">
Reach us for inquiries, orders, and support. We're happy to help you.
</p>

<div class="row g-4 align-items-start">

<!-- GOOGLE MAP -->

<div class="col-md-6">

<div style="border-radius:12px; overflow:hidden; border:1px solid #1e1e1e;">

<iframe
src="https://www.google.com/maps?q=Bandung,Indonesia&output=embed"
width="100%"
height="420"
style="border:0;"
loading="lazy">
</iframe>

</div>

</div>


<!-- CONTACT INFORMATION -->

<div class="col-md-6">

<div style="background:#111; border:1px solid #1e1e1e; border-radius:16px; padding:35px;">

<h4 style="margin-bottom:15px;">Fagioli Reali Coffee</h4>

<p style="color:#aaa; margin-bottom:25px;">
We serve premium coffee beans sourced from the finest farms.
Feel free to visit our store or contact us through the information below.
</p>

<hr style="border-color:#1e1e1e;">

<p style="margin-top:20px;">
<strong>📍 Address</strong><br>
Bandung, West Java, Indonesia
</p>

<p>
<strong>📞 Phone</strong><br>
+62 812 3456 7890
</p>

<p>
<strong>✉ Email</strong><br>
hello@fagiolireali.com
</p>

<hr style="border-color:#1e1e1e; margin:25px 0;">

<h6 style="margin-bottom:15px;">Follow Us</h6>

<div style="display:flex; gap:10px; flex-wrap:wrap;">

<a href="#" class="btn-coffee">Instagram</a>

<a href="#" class="btn-coffee">TikTok</a>

<a href="#" class="btn-coffee">WhatsApp</a>

</div>

</div>

</div>

</div>

</div>

</section>

@endsection