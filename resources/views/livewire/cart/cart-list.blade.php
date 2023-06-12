<div>
    
    @include('partials.success_toast')
    @include('partials.error_toast')
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
  
        <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="flex items-center justify-between dark:text-white">
            <h2 class="text-2xl font-semibold">Shopping Cart</h2>
          </div>
          <div class=" mt-3 flex items-center dark:text-white">
            <input wire:model="checkAll" {{-- id="check_all" --}} wire:click="checkAllItems" type="checkbox" class="h-5 w-5 rounded">
            <span class="ml-2 text-gray-700 dark:text-white">Select All</span>
            @if(count($selected_cart_items) > 0 && !$deletionCompleted)
            <a class="text-blue-600 ml-auto" href="#" wire:click.prevent="deleteSelectedItems" wire:loading.attr="disabled">
              Hapus yang dipilih
            </a>
            @endif   
          </div>
          
          <hr class="my-4 border-t border-gray-300">
          @foreach ($cartitems as $item)
          <div wire:key="cart-item-{{ $item->id }}" class=" mt-3 max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            <div class="grid grid-cols-4 gap-4">
                <div class="flex items-center col-span-1">
                  <input wire:model="selected_cart_items" id="cart_check_{{ $item->id }}" type="checkbox" value="{{ $item->id }}" class="h-5 w-5 mr-2 rounded">      
                <img src="{{ asset('storage/' . $item->product->image) }}" class="h-20 w-20 rounded-md">
              </div>
              <div class="col-span-2">
                <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                <p class="text-gray-500">{{ 'Rp' . number_format($item->product->price, 0, ',', '.') }}</p>
              </div>
              <div class="flex items-center col-span-1">
                <div class="custom-number-input h-10 w-32">
                  <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                    <button class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-500 h-7 w-6 rounded-l cursor-pointer outline-none"
                    wire:click="decrementQty({{ $item->id }})">
                      <span class="m-auto text-2xl font-thin">−</span>
                    </button>
                    <span class="p-2">{{ $item->quantity }}</span>
                    <button class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-500 h-7 w-6 rounded-r cursor-pointer"
                    wire:click="incrementQty({{ $item->id }})">
                      <span class="m-auto text-2xl font-thin">+</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          
        </div>
      
        <div  class=" max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:text-white">
          <div class="container mx-auto">
            <div class="rounded-md p-6">
              <h2 class="text-2xl font-semibold">Order Summary</h2>
              <div class="mt-4">
                <div class="flex justify-between py-2">
                  <span class="text-gray-700 dark:text-gray-400">Subtotal ({{ count($selected_cart_items) }}) items</span>
                  <span class="font-semibold">{{ 'Rp' . number_format($sub_total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-2">
                  <span class="text-gray-700 dark:text-gray-400">Tax estimate</span>
                  <span class="font-semibold"> {{ $tax }}</span>
                </div>
                <div class="flex justify-between border-t border-gray-300 py-2">
                  <span class="text-xl font-semibold">Order total</span>
                  <span class="text-xl font-semibold">{{ 'Rp' . number_format($this->total, 0, ',', '.') }}</span>
                </div>
      
                <label for="small" class="block mb-3 text-xl font-medium text-gray-900 dark:text-white">Silahkan pilih metode pembayaran</label>
                <select wire:model="payment_method" id="payment_method" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Pilih metode pembayaran</option>
                <option value="cash">Cash </option>
                <option value="transfer">Transfer E-Wallet</option>
                
                </select>
      
                @if($errors->has('payment_method'))
                    <span class="text-red-500 text-sm">{{ $errors->first('payment_method') }}</span>
                @endif
                
                @if (empty($selected_cart_items))
                    <div>
                        <span class="text-red-500 text-sm">Pilih salah satu produk</span>
                    </div>
                @endif
      
                {{-- <button class="bg-blue-500 text-white rounded-md px-4 py-2 mt-4 hover:bg-blue-600">Checkout</button> --}}
                <button
                    class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-blue-600 rounded-full shadow item-center hover:bg-blue-700 focus:shadow-outline focus:outline-none
                    @if (empty($selected_cart_items)) opacity-50 cursor-not-allowed @else bg-blue-600 hover:bg-blue-700 @endif"
                    wire:click="checkout" wire:loading.attr="disabled" type="submit"
                    wire:click="$set('payment_method', '')"
                    @if (empty($selected_cart_items)) disabled @endif>
                    <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path fill="currentColor"
                            d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z" />
                    </svg>
                    <span class="ml-2 mt-5px">CHECKOUT @if (!empty($selected_cart_items)) ({{ count($selected_cart_items) }}) @endif</span>
                </button>
                <div wire:loading>Pembayaran sedang di proses....</div>
              </div>
            </div>
          </div>
          
        </div>
      
        
      
      </div>   
</div>
