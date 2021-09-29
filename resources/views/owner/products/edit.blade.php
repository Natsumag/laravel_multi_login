<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <form method="post" action="{{ route('owner.products.update', ['product' => $product->id]) }}">
                        @csrf
                        @method('put')
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">Product Name</label>
                                    <input type="text" id="name" name="name" value="{{ $product->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="information" class="leading-7 text-sm text-gray-600">ShopInformation</label>
                                    <textarea id="information" name="information" rows="3" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $product->information }}</textarea>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="price" class="leading-7 text-sm text-gray-600">price</label>
                                    <input type="number" id="price" name="price" value="{{ $product->price }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="sort_order" class="leading-7 text-sm text-gray-600">Sort Order</label>
                                    <input type="number" id="sort_order" name="sort_order" value="{{ $product->sort_order }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="current_quantity" class="leading-7 text-sm text-gray-600">Quantity</label>
                                    <input type="hidden" id="current_quantity" name="current_quantity" value="{{ $quantity }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <div class="w-full bg-gray-100 bg-opacity-50 rounded">{{ $quantity }}</div>
                                </div>
                            </div>

                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative flex justify-around">
                                    <input type="radio" name="is_selling" id="type" value="{{ \Constant::PRODUCT_LIST['add'] }}" checked>
                                    <label for="is_selling">Add</label>
                                    <input type="radio" name="is_selling" id="type" value="{{ \Constant::PRODUCT_LIST['reduce'] }}">
                                    <label for="not_selling">Remove</label>
                                </div>
                            </div>

                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="quantity" class="leading-7 text-sm text-gray-600">Quantity</label>
                                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="shop_id" class="leading-7 text-sm text-gray-600">shop name</label>
                                    <select name="shop_id" id="shop_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        @foreach($shops as $shop)
                                            <option value="{{ $shop->id }}" @if($shop->id === $product->shop_id) selected @endif>
                                                {{ $shop->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="category" class="leading-7 text-sm text-gray-600">category</label>
                                    <select name="category" id="v" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        @foreach($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach($category->secondaryCategory as $secondary)
                                                    <option value="{{ $secondary->id }}" @if($secondary->id === $product->secondary_category_id) selected @endif>
                                                        {{ $secondary->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <x-select-image :images="$images" name="image1" currendId="{{ $product->image_id }}" currentImage="{{ $product->imageFirst->filename ?? '' }}" />
{{--                            <x-select-image :images="$images" name="image2" currendId="{{ $product->image2 }}" currentImage="{{ $product->imageSecond->filename ?? '' }}" />--}}
{{--                            <x-select-image :images="$images" name="image3" currendId="{{ $product->image3 }}" currentImage="{{ $product->imageThird->filename ?? '' }}" />--}}
{{--                            <x-select-image :images="$images" name="image4" currendId="{{ $product->image4 }}" currentImage="{{ $product->imageForth->filename ?? '' }}" />--}}
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative flex justify-around">
                                    <input type="radio" name="is_selling" id="is_selling" value="1" @if($product->is_selling === 1){ checked } @endif >
                                    <label for="is_selling">Selling</label>
                                    <input type="radio" name="is_selling" id="not_selling" value="0" @if($product->is_selling === 0){ checked } @endif>
                                    <label for="not_selling">Stopping</label>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="p-2 w-full flex justify-around mt-4">
                                    <button type="button" onclick="location.href='{{ route('owner.products.index') }}'" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">Back</button>
                                    <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="post" action="{{ route('owner.products.destroy', ['product' => $product->id]) }}" id="delete_{{ $product->id }}">
                        @csrf
                        @method('delete')
                        <div class="p-2 w-full flex justify-around mt-32">
                            <a href="#" data-id="{{ $product->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded ">Delete</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        'use strict'
        const images = document.querySelectorAll('.image')

        images.forEach( image =>  {
            image.addEventListener('click', function(e){
                const imageName = e.target.dataset.id.substr(0, 6)
                const imageId = e.target.dataset.id.replace(imageName + '_', '')
                const imageFile = e.target.dataset.file
                const imagePath = e.target.dataset.path
                const modal = e.target.dataset.modal
                document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
                document.getElementById(imageName + '_hidden').value = imageId
                MicroModal.close(modal);
            }, )
        })

        function deletePost(e) {
            'use strict';
            if(confirm('削除しますか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>

</x-app-layout>
