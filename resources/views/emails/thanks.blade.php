<p class="mb-4">{{ $user->name }}</p>
<p class="mb-4">Thanks Purchase</p>
@foreach ($products as $product)
    <ul class="mb-4">
        <li>{{ $product['name'] }}</li>
        <li>$ {{ number_format($product['price']) }} × {{ $product['quantity'] }}</li>
        <li>subTotal:$ {{ number_format($product['price'] * $product['quantity']) }}</li>
    </ul>
@endforeach
