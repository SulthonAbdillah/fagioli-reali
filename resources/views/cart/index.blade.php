<h1>Keranjang Belanja</h1>

<a href="/shop">Kembali ke Shop</a>

<hr>

@if($cart)

@foreach($cart as $id => $item)

<div>

<h3>{{ $item['name'] }}</h3>

<p>Harga: Rp {{ $item['price'] }}</p>

<p>Jumlah: {{ $item['quantity'] }}</p>

<form action="/cart/remove/{{ $id }}" method="POST">
@csrf
<button type="submit">Hapus</button>
</form>

</div>

<hr>

@endforeach

<form action="/checkout" method="POST">
@csrf
<button type="submit">Checkout</button>
</form>

@else

<p>Keranjang kosong</p>

@endif