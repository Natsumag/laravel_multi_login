<p class="mb-4">{{ $product['ownerName'] }}</p>
<p class="mb-4">Orderd</p>
    <ul class="mb-4">
        <li>{{ $product['name'] }}</li>
        <li>$ {{ number_format($product['price']) }} × {{ $product['quantity'] }}</li>
        <li>subTotal:$ {{ number_format($product['price'] * $product['quantity']) }}</li>
    </ul>

<p class="mb-4">Purchase</p>
{{ $user->name }}
