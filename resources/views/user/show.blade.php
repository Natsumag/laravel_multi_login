<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex md:justify-around">
                        <div class="md:w-1/2 mr-4">
                        <!-- Slider main container -->
                            <div class="swiper">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        @if($product->image->filename !== null)
                                            <img src="{{ asset('storage/products/' . $product->image->filename) }}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if($product->imageSecond->filename !== null)
                                            <img src="{{ asset('storage/products/' . $product->imageSecond->filename) }}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if($product->imageThird->filename !== null)
                                            <img src="{{ asset('storage/products/' . $product->imageThird->filename) }}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if($product->imageForth->filename !== null)
                                            <img src="{{ asset('storage/products/' . $product->imageForth->filename) }}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>

                                <!-- If we need scrollbar -->
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
                        <div class="md:w-1/2 ml-4">
                            <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $product->secondaryCategory->name }}</h2>
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
                            <p class="leading-relaxed">{{ $product->information }}</p>
                            <div class="flex">
                                <span class="title-font font-medium text-2xl text-gray-900">${{ number_format($product->price) }}</span>
                                <form method="post" action="{{ route('user.cart.add') }}">
                                    @csrf
                                    <div class="flex items-center ml-10">
                                        <span class="mr-3">Quality</span>
                                        <div class="relative">
                                            <select name="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                                @for ($i = 1; $i<=$quantity; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                                <path d="M6 9l6 6 6-6"></path>
                                            </svg>
                                        </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Add Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="border-t my-8">
                        <div class="mb-4 text-center">Shop</div>
                        <div class="mb-4 text-center">{{ $product->shop->name }}</div>
                        <div class="mb-4 text-center">
                            @if($product->shop->filename !== null)
                                <img src="{{ asset('storage/shops/' . $product->shop->filename) }}" class="w-40 h-40 rounded-full mx-auto">
                            @else
                                <img src="">
                            @endif
                        </div>
                        <div class="mb-4 text-center">
                            <button type="button" data-micromodal-trigger="modal-1" href="javascript:;" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                        {{ $product->shop->name }}
                    </h2>
                    <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <p>
                        Try hitting the <code>tab</code> key and notice how the focus stays within the modal itself. Also, <code>esc</code> to close modal.
                    </p>
                </main>
                <footer class="modal__footer">
                    <button type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
                </footer>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>
