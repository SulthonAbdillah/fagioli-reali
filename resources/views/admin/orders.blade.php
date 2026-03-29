@extends('layouts.admin')

@section('content')

<div class="container py-5">

<h2 class="mb-4">Order History</h2>

@if(empty($orders))

<div class="alert alert-info">
No orders found
</div>

@else

@foreach($orders as $id => $order)

<div class="card mb-4 shadow">

<div class="card-body">

<h5>Order ID: {{ $id }}</h5>

<p>
<b>Customer:</b>
{{ $order['customer_name'] ?? $order['user'] ?? '-' }}
</p>

<p>
<b>Email:</b>
{{ $order['customer_email'] ?? $order['email'] ?? '-' }}
</p>

<p>
<b>Date:</b>
{{ $order['date'] ?? '-' }}
</p>

<p>
<b>Total:</b>
Rp {{ number_format($order['total'] ?? 0) }}
</p>

<hr>

<h6>Items</h6>

<ul>

@if(isset($order['items']))

@foreach($order['items'] as $item)

<li>

{{ $item['name'] ?? '-' }}
x {{ $item['quantity'] ?? 0 }}
- Rp {{ number_format($item['price'] ?? 0) }}

</li>

@endforeach

@endif

</ul>

</div>

</div>

@endforeach

@endif

</div>

@endsection