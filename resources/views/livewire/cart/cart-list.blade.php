<div>
    @include('partials.success_toast')
    @include('partials.error_toast')
    <div class="flex justify-center my-6">
        <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
            <div class="flex-1">
                <table class="w-full text-sm lg:text-base" cellspacing="0">
                    <thead>
                        <tr class="h-12 uppercase">
                            <th class="hidden md:table-cell"></th>
                            <th>
                                
                            </th>
                            <th class="text-left">Produk</th>
                            <th class="lg:text-right text-left pl-5 lg:pl-0">
                                <span class="lg:hidden" title="Quantity">Qtd</span>
                                <span class="hidden lg:inline">Jumlah</span>
                            </th>
                            <th class="hidden text-right md:table-cell">Harga per barang</th>
                            <th class="text-right">Harga total</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input  wire:model="checkAll" id="check_all" wire:click="checkAllItems" type="checkbox"
                                    class="w-4 mb-7 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </td>
                            
                            <td class="pb-7" >Pilih semua</td>

                            <td>
                                @if(count($selected_cart_items) > 0 && !$deletionCompleted)
                                    <a class="text-green-600" href="#" wire:click.prevent="deleteSelectedItems" wire:loading.attr="disabled">
                                        Hapus yang dipilih
                                    </a>
                                @endif                              
                            </td>
                        </tr>

                        @foreach ($cartitems as $item)
                            <tr  wire:key="cart-item-{{ $item->id }}">
                                <td>
                                    <input wire:model="selected_cart_items" id="cart_check_{{ $item->id }}" type="checkbox"
                                        value="{{ $item->id }}"
                                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="hidden pb-4 md:table-cell">
                                    <a href="#">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-20 rounded"
                                            alt="Thumbnail" />
                                    </a>
                                </td>
                                <td>
                                    <p class="mb-2 md:ml-4">{{ $item->product->name }}</p>
                                </td>
                                <td class="justify-center md:justify-end md:flex mt-6">
                                    <div class="w-20 h-10">
                                        <div class="custom-number-input h-10 w-32">
                                            <div
                                                class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                                <button
                                                    class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-500 h-9 w-8 rounded-l cursor-pointer outline-none"
                                                    wire:click="decrementQty({{ $item->id }})">
                                                    <span class="m-auto text-2xl font-thin">−</span>
                                                </button>
                                                <span class="p-2">{{ $item->quantity }}</span>
                                                <button
                                                    class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-500 h-9 w-8 rounded-r cursor-pointer"
                                                    wire:click="incrementQty({{ $item->id }})">
                                                    <span class="m-auto text-2xl font-thin">+</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden text-center md:table-cell">
                                    <span class="text-sm lg:text-base font-medium">
                                        RP {{ $item->product->price }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="text-sm lg:text-base font-medium">
                                        Rp {{ $item->product->price * $item->quantity }}
                                    </span>
                                </td>
                                <td class="hidden text-right md:table-cell">
                                    <button type="submit" style="display: inline-block; padding: 10px; transition: transform 0.3s;" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';" class="md:ml-4 "
                                    wire:click="removeItem({{ $item->id }})">
                                    <?xml version="1.0" encoding="utf-8"?><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25.294px" height="27.88px" viewBox="0 0 108.294 122.88" enable-background="new 0 0 108.294 122.88" xml:space="preserve"><g><path d="M4.873,9.058h33.35V6.2V6.187c0-0.095,0.002-0.186,0.014-0.279c0.075-1.592,0.762-3.037,1.816-4.086l-0.007-0.007 c1.104-1.104,2.637-1.79,4.325-1.806l0.023,0.002V0h0.031h19.884h0.016c0.106,0,0.207,0.009,0.309,0.022 c1.583,0.084,3.019,0.76,4.064,1.81c1.102,1.104,1.786,2.635,1.803,4.315l-0.003,0.021h0.014V6.2v2.857h32.909h0.017 c0.138,0,0.268,0.014,0.401,0.034c1.182,0.106,2.254,0.625,3.034,1.41l0.004,0.007l0.005-0.007 c0.851,0.857,1.386,2.048,1.401,3.368l-0.002,0.032h0.014v0.032v10.829c0,1.472-1.195,2.665-2.667,2.665h-0.07H2.667 C1.195,27.426,0,26.233,0,24.762v-0.063V13.933v-0.014c0-0.106,0.004-0.211,0.018-0.315v-0.021 c0.089-1.207,0.624-2.304,1.422-3.098l-0.007-0.002C2.295,9.622,3.49,9.087,4.81,9.069l0.032,0.002V9.058H4.873L4.873,9.058z M77.79,49.097h-5.945v56.093h5.945V49.097L77.79,49.097z M58.46,49.097h-5.948v56.093h5.948V49.097L58.46,49.097z M39.13,49.097 h-5.946v56.093h5.946V49.097L39.13,49.097z M10.837,31.569h87.385l0.279,0.018l0.127,0.007l0.134,0.011h0.009l0.163,0.023 c1.363,0.163,2.638,0.789,3.572,1.708c1.04,1.025,1.705,2.415,1.705,3.964c0,0.098-0.009,0.193-0.019,0.286l-0.002,0.068 l-0.014,0.154l-7.393,79.335l-0.007,0.043h0.007l-0.016,0.139l-0.051,0.283l-0.002,0.005l-0.002,0.018 c-0.055,0.331-0.12,0.646-0.209,0.928l-0.007,0.022l-0.002,0.005l-0.009,0.018l-0.023,0.062l-0.004,0.021 c-0.118,0.354-0.264,0.698-0.432,1.009c-1.009,1.88-2.879,3.187-5.204,3.187H18.13l-0.247-0.014v0.003l-0.011-0.003l-0.032-0.004 c-0.46-0.023-0.889-0.091-1.288-0.202c-0.415-0.116-0.818-0.286-1.197-0.495l-0.009-0.002l-0.002,0.002 c-1.785-0.977-2.975-2.882-3.17-5.022L4.88,37.79l-0.011-0.125l-0.011-0.247l-0.004-0.116H4.849c0-1.553,0.664-2.946,1.707-3.971 c0.976-0.955,2.32-1.599,3.756-1.726l0.122-0.004v-0.007l0.3-0.013l0.104,0.002V31.569L10.837,31.569z M98.223,36.903H10.837 v-0.007l-0.116,0.004c-0.163,0.022-0.322,0.106-0.438,0.222c-0.063,0.063-0.104,0.132-0.104,0.179h-0.007l0.007,0.118l7.282,79.244 h-0.002l0.002,0.012c0.032,0.376,0.202,0.691,0.447,0.825l-0.002,0.004l0.084,0.032l0.063,0.012h0.077h72.695 c0.207,0,0.399-0.157,0.518-0.377l0.084-0.197l0.054-0.216l0.014-0.138h0.005l7.384-79.21L98.881,37.3 c0-0.045-0.041-0.111-0.103-0.172c-0.12-0.118-0.286-0.202-0.451-0.227L98.223,36.903L98.223,36.903z M98.334,36.901h-0.016H98.334 L98.334,36.901z M98.883,37.413v-0.004V37.413L98.883,37.413z M104.18,37.79l-0.002,0.018L104.18,37.79L104.18,37.79z M40.887,14.389H5.332v7.706h97.63v-7.706H67.907h-0.063c-1.472,0-2.664-1.192-2.664-2.664V6.2V6.168h0.007 c-0.007-0.22-0.106-0.433-0.259-0.585c-0.137-0.141-0.324-0.229-0.521-0.252h-0.082h-0.016H44.425h-0.031V5.325 c-0.213,0.007-0.422,0.104-0.576,0.259l-0.004-0.004l-0.007,0.004c-0.131,0.134-0.231,0.313-0.259,0.501l0.007,0.102V6.2v5.524 C43.554,13.196,42.359,14.389,40.887,14.389L40.887,14.389z"/></g></svg>
                                </button>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <hr class="pb-6 mt-6" />
                <div class="my-4 mt-6 -mx-2 lg:flex">
                    <div class="lg:px-2 lg:w-1/2"></div>
                    <div class="lg:px-2 lg:w-1/2">
                        <div class="p-4 bg-blue-200 rounded-full">
                            <h1 class="ml-2 font-bold uppercase">Detail produk</h1>
                            
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Subtotal
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                    Rp {{ $sub_total }}
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Pajak
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                    Rp {{ $tax }}
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Total
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                    Rp {{ $this->total }}
                                </div>
                            </div>
                            {{-- transaction.store --}}
                            {{-- <form wire:submit.prevent="checkout"> --}}

                            <label for="small" class="block mt-8 mb-3 text-xl font-medium text-gray-900 dark:text-black">Silahkan pilih metode pembayaran</label>
                            <select wire:model="payment_method" id="payment_method" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Pilih metode pembayaran</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="ewallet">E-Wallet</option>
                            <option value="creditcard">Kartu Kredit</option>
                            </select>

                            @if($errors->has('payment_method'))
                                <span class="text-red-500 text-sm">{{ $errors->first('payment_method') }}</span>
                            @endif
                            
                            @if (empty($selected_cart_items))
                                <div>
                                    <span class="text-red-500 text-sm">Pilih salah satu produk</span>
                                </div>
                            @endif


                                <button
                                    class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none
                                    @if (empty($selected_cart_items)) opacity-50 cursor-not-allowed @else bg-gray-800 hover:bg-gray-700 @endif"
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
                            {{-- </form> --}}
                            <div wire:loading>Pembayaran sedang di proses....</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
