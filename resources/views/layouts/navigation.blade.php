<nav class="bg-black shadow-lg">

<div class="max-w-7xl mx-auto px-6">

<div class="flex justify-between items-center h-16">

<!-- LOGO -->
<a href="/shop" class="text-2xl font-bold text-yellow-500">
☕ Fagioli Reali
</a>


<!-- MENU -->
<div class="flex items-center space-x-6">

@if(Auth::user()->role === 'admin')

<a href="/admin" class="text-gray-200 hover:text-yellow-500">
Dashboard
</a>

<a href="/products" class="text-gray-200 hover:text-yellow-500">
Products
</a>

@else

<a href="/shop" class="text-gray-200 hover:text-yellow-500">
Home
</a>

<a href="/about" class="text-gray-200 hover:text-yellow-500">
About
</a>

<a href="/products-list" class="text-gray-200 hover:text-yellow-500">
Products
</a>

<a href="/cart" class="text-gray-200 hover:text-yellow-500">
Cart
</a>

<a href="/contact" class="text-gray-200 hover:text-yellow-500">
Contact
</a>

@endif

</div>


<!-- USER -->
<div class="flex items-center space-x-4">

<span class="text-gray-300 text-sm">
{{ Auth::user()->name }}
</span>

<a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-yellow-500">
Profile
</a>

<form method="POST" action="{{ route('logout') }}">
@csrf

<button
type="submit"
class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg text-sm">
Logout
</button>

</form>

</div>

</div>

</div>

</nav>