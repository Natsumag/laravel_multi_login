<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <div class="md:flex md:items-center mb-2">
                                <div class="md:w-3/12">
                                    @if($product->image->filename !== null)
                                        <img src="{{ asset('storage/products/' . $product->image->filename) }}">
                                    @else
                                        <img src="">
                                    @endif
                                </div>
                                <div class="md:w-3/12">{{ $product->name }}</div>
                                <div class="md:w-3/12 flex justify-around">
                                    <div>Quantity: {{ $product->pivot->quantity }}</div>
                                    <div>$ {{ number_format($product->pivot->quantity * $product->price) }}</div>
                                </div>
                                <div class="md:w-3/12">
                                    <form method="post" action="{{ route('user.cart.delete', ['cart' => $product->id]) }}">
                                        @csrf
                                        <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <div class="my-2">
                            subTotal: $ {{number_format($totalPrice)}}
                        </div>
                        <div>
                            <button onclick="location.href='{{ route('user.cart.checkout') }}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Purchase</button>
                        </div>
                    @else
                        Not Be Added in Cart
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
