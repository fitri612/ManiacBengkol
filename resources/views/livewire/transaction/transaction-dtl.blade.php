<div>
    @include('partials.success_toast')
    <p class="text-lg font-bold text-gray-900 dark:text-white">Checkout</p>
    <div class="grid grid-cols-2 gap-5  justify-center">
    <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
       
        
        @foreach ($transaction_detail as $detail)
            <div class="dark:text-white">
                <p>Transaction ID: {{ $detail->transaction_id }}</p>
                <p>product ID {{ $detail->product_id }}</p>
                <p>product {{ $detail->product }}</p>
                <img src="{{ asset('storage/' . $detail->image) }}" alt="Product Image" height="100px" width="100px">
                <p>jumlah yg dipesan : {{ $detail->qty }}</p>
                <p>harga produk : Rp.{{ number_format($detail->price, 0, ',', '.') }}</p>
            </div>
            <br>
        @endforeach

    </div>

    <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        
    
        <h2 class="dark:text-white">Code Invoice:
            @if ($InvoiceCode)
            {{ $InvoiceCode->code_invoice }}
            @else
            @endif
            <h2>
            <br>
        <table class="table-auto">
            <tr>
                <th colspan="2" class="text-gray-900 dark:text-white">ringkasan belanja</th>
                <th rowspan="3"></th>
            </tr>
            {{-- @foreach ($payment_detail as $item) --}}
            <tr>
                <td class="text-gray-900 dark:text-white">
                    total harga ({{ $totalQty }}) : 
                </td>
                <td class="text-gray-900 dark:text-white">Rp.{{ number_format($totalPrice, 0, ',', '.') }}<td>
            </tr>
            <tr>
                
                <th class="p-3 text-gray-900 dark:text-white">
                    total tagihan :
                </th>
                <th class="text-gray-900 dark:text-white">Rp.{{ number_format($totalPrice, 0, ',', '.') }}</th>
            </tr>
            {{-- @endforeach --}}

        </table>

        

        <p class="mt-2 text-center text-md text-gray-500 dark:text-gray-400 font-semibold">upload bukti transfer</p>
        <div class="m-5 flex items-center justify-center w-full">
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-80 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    @if ($image)
                    <div class="w-full h-64 mb-3">
                        <img src="{{ $image->temporaryUrl() }}" wire:model="image" class="w-full h-full object-contain" alt="Image Preview">
                    </div>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to update image</span> or drag and drop</p>
                    @else
                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    @endif
                </div>
                <input id="dropzone-file" type="file" wire:model="image" class="hidden"/>
            </label>
        </div>
        <button wire:click="confirm_payment" type="button" class=" mt-5 text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">confirm payment</button>
    </div>
    </div>
</div>
