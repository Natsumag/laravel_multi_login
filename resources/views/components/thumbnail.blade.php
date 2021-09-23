@php
if ($type === 'shops') {
    $path = 'storage/shops/';
}
if ($type === 'products') {
    $path = 'storage/products/';
}
@endphp
<div>
    @if(empty($filename))
        <p>No Image</p>
    @else
        <img src="{{ asset($path . $filename) }}">
    @endif
</div>
