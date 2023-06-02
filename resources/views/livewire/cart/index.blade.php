<div>
    @if (session()->has('success'))
        <div class="flex bg-green-100 rounded-lg p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @include('partials.success_toast')

    @if ($selectedProduct)
        @livewire('product.product-detail', ['selectedProduct' => $selectedProduct], key('product-detail-' . $selectedProduct->id))
        {{-- @livewire('product.product-detail', ['selectedProduct' => $selectedProduct]) --}}
        {{-- <p>Product Name: {{ $selectedProduct->price }}</p> --}}
    @else
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($products as $item)
                        <div class="group relative">
                            <div
                                class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                <img src="{{ asset('storage/' . $item->image) }}"
                                    alt="Front of men&#039;s Basic Tee in black."
                                    class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <a href="#" wire:click="getProduct({{ $item->id }}) ">
                                        <h3 class="text-sm text-gray-700 max-w-64">
                                            {{ $item->name }}
                                        </h3>
                                    </a>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Rp{{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <button wire:click="addToCart({{ $item->id }})"
                                    class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span class="text-lg mr-2 flex-shrink-0">
                                        <i class="fas fa-shopping-cart"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- @livewire('admin.transaction-list') --}}
</div>
