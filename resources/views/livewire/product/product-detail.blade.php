<div>
    @include('partials.success_toast')
    @if ($selectedProduct)
        <button wire:click="BackToList" type="button"
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Back</button>
        <section class="text-gray-700 body-font overflow-hidden bg-white">
            <div class="container px-5 py-24 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200"
                        src="{{ asset('storage/' . $selectedProduct->image) }}">
                    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">Detail Product</h2>
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $selectedProduct->name }}</h1>
                        <div class="flex mb-4">
                            <span class="flex items-center">
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <span class="text-gray-600 ml-3">4 Reviews</span>
                            </span>
                            <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                                <p>
                                    <span class="text-gray-600">stock</span>
                                    <span class="font-medium text-gray-700 title-font ml-2">
                                        {{ $selectedProduct->stock }}
                                    </span>
                                </p>
                            </span>
                        </div>
                        <p class="leading-relaxed">{{ $selectedProduct->description }}.</p>
                        <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                            <div class="flex">
                                <span class="mr-3">Rating</span>
                                <div class="flex items-center">
                                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5 text-yellow-400">
                                        <path
                                            d="M10 12l-4.55 3.3 1.73-5.36L2.38 6.7l5.37-.02L10 1.34l2.25 5.34 5.37.02-4.8 3.24 1.73 5.36L10 12z" />
                                    </svg>
                                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5 text-yellow-400">
                                        <path
                                            d="M10 12l-4.55 3.3 1.73-5.36L2.38 6.7l5.37-.02L10 1.34l2.25 5.34 5.37.02-4.8 3.24 1.73 5.36L10 12z" />
                                    </svg>
                                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5 text-yellow-400">
                                        <path
                                            d="M10 12l-4.55 3.3 1.73-5.36L2.38 6.7l5.37-.02L10 1.34l2.25 5.34 5.37.02-4.8 3.24 1.73 5.36L10 12z" />
                                    </svg>
                                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5 text-gray-300">
                                        <path
                                            d="M10 12l-4.55 3.3 1.73-5.36L2.38 6.7l5.37-.02L10 1.34l2.25 5.34 5.37.02-4.8 3.24 1.73 5.36L10 12z" />
                                    </svg>
                                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5 text-gray-300">
                                        <path
                                            d="M10 12l-4.55 3.3 1.73-5.36L2.38 6.7l5.37-.02L10 1.34l2.25 5.34 5.37.02-4.8 3.24 1.73 5.36L10 12z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <span
                                class="title-font font-medium text-2xl text-gray-900">Rp{{ number_format($selectedProduct->price, 0, ',', '.') }}</span>
                            <button wire:click="addToCart({{ $selectedProduct->id }})" type="button"
                                class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        @livewire('cart.index')
    @endif
</div>
