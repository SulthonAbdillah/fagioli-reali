<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<style>

body{
font-family: Arial, sans-serif;
background:#f5f5f5;
padding:30px;
}

.invoice-container{

max-width:600px;
margin:auto;
background:white;
border-radius:10px;
overflow:hidden;
box-shadow:0 5px 15px rgba(0,0,0,0.1);

}

.header{

background:#3e2723;
color:white;
padding:20px;
text-align:center;

}

.header h1{
margin:0;
}

.content{
padding:30px;
}

table{

width:100%;
border-collapse:collapse;

}

th{

text-align:left;
border-bottom:2px solid #ddd;
padding:10px;

}

td{

padding:10px;
border-bottom:1px solid #eee;

}

.total{

font-size:18px;
font-weight:bold;
text-align:right;
padding-top:20px;

}

.footer{

background:#fafafa;
text-align:center;
padding:15px;
font-size:12px;
color:#888;

}

</style>

</head>

<body>

<div class="invoice-container">

<div class="header">

<h1>Fagioli Reali</h1>

<p>Order Invoice</p>

</div>

<div class="content">

<p>Thank you for your order ☕</p>

<table>

<thead>

<tr>

<th>Product</th>
<th>Qty</th>
<th>Price</th>

</tr>

</thead>

<tbody>

@foreach($cart as $item)

<tr>

<td>{{ $item['name'] }}</td>

<td>{{ $item['quantity'] }}</td>

<td>

Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}

</td>

</tr>

@endforeach

</tbody>

</table>

<p class="total">

Total : Rp {{ number_format($total,0,',','.') }}

</p>

</div>

<div class="footer">

Fagioli Reali © {{ date('Y') }}

</div>

</div>

</body>

</html>