@extends('layouts.admin')

@section('content')

<div class="container py-5">

<h2 class="mb-4">Order History</h2>

@if($orders->isEmpty())

<div class="alert alert-info">
No orders found
</div>

@else

@foreach($orders as $order)

<div class="card mb-4 shadow">
<div class="card-body">

<h5>Order ID: {{ $order->id }}</h5>

<p>
<b>Customer:</b> {{ $order->user_name }}
</p>

<p>
<b>Email:</b> {{ $order->email }}
</p>

<p>
<b>Date:</b> {{ $order->created_at }}
</p>

<p>
<b>Total:</b> Rp {{ number_format($order->total) }}
</p>

<hr>

<h6>Items</h6>

<ul>
@foreach($order->items as $item)
<li>
{{ $item['name'] ?? '-' }}
x {{ $item['quantity'] ?? 0 }}
- Rp {{ number_format($item['price'] ?? 0) }}
</li>
@endforeach
</ul>

</div>
</div>

@endforeach

@endif

</div>

@endsection