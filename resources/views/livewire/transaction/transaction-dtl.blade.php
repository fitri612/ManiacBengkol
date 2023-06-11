<div>
    @include('partials.success_toast')
    <p class="text-lg font-bold text-gray-900 dark:text-white">Checkout</p>
    
    <div class="grid grid-cols-2 gap-5  justify-center">
    <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
       
        
        @foreach ($transaction_detail as $detail)
            <div class="dark:text-white">
                <p>Transaction ID: {{ $detail->transaction_id }}</p>
                <p>product ID {{ $detail->product_id }}</p>
                <p>product name: {{ $detail->name }}</p>
                <img src="{{ asset('storage/' . $detail->image) }}" alt="Product Image">
                <p>jumlah yg dipesan : {{ $detail->qty }}</p>
                <p>harga produk : {{ $detail->price }}</p>
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
                <td class="text-gray-900 dark:text-white">{{ $totalPrice  }}<td>
            </tr>
            <tr>
                
                <th class="p-3 text-gray-900 dark:text-white">
                    total tagihan :
                </th>
                <th class="text-gray-900 dark:text-white">{{ $totalPrice }}</th>
            </tr>
            <tr>
                
                <th class="dark:text-white font-semibold">
                    metode pembayaran : {{ $latestTransaction->method_payment }}
                <p>silahkan tranfer dana ovo gopay</p></th>
            </tr>
            {{-- @endforeach --}}

        </table>

        
    @if ($latestTransaction && $latestTransaction->method_payment === 'cash')
    <div class="dark:text-white font-semibold">
        <p>silahkan pergi ke tkp langsung </p>
    </div>
    @elseif ($latestTransaction && $latestTransaction->method_payment === 'transfer')
        <p class="mt-2 text-center text-md text-gray-500 dark:text-gray-400 font-semibold">upload bukti transfer</p>
        {{-- <div class="m-5 flex items-center justify-center w-full">
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
        </div> --}}
        
        <input  {{-- wire:model="image_note" --}}  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" onchange="previewImage(event)">

        <img id="imgPreview" class="img-preview" src="#" alt="Image Preview" style="display: none; max-width: 250px;max-height:250px;margin:0;">
        <button {{-- wire:click="confirm_payment" --}} data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class=" mt-5 text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">confirm payment</button>
        <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin akan konfirmasi pembayaran?</h3>
                        <p class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">cek kembali bukti pembayaran agar proses proses transaksi berjalan lancar</p>
                        <button wire:click="confirm_payment" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- <div class="flex items-center justify-center w-full">
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG, or GIF (MAX. 800x400px)</p>
              </div>
              <input wire:model="image" id="dropzone-file" type="file" class="hidden" onchange="previewImage(event)" />
            </label>
          </div>
          <button wire:click="confirm_payment" type="button" class=" mt-5 text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">confirm payment</button>
          
          <script>
            function previewImage(event) {
              const file = event.target.files[0];
              const reader = new FileReader();
          
              reader.onload = function() {
                const imgElement = document.createElement('img');
                imgElement.src = reader.result;
                imgElement.classList.add('w-32', 'h-auto', 'mt-4');
          
                const previewContainer = document.querySelector('.flex.items-center.justify-center.w-full');
                previewContainer.appendChild(imgElement);
              };
          
              if (file) {
                reader.readAsDataURL(file);
              }
            }
          </script> --}}
          
    @endif
    
    
    

    {{-- <script>
        function previewImage(event) {
            const image = event.target.files[0];
            const imgPreview = document.getElementById('imgPreview');

            imgPreview.style.display = 'block';
            const reader = new FileReader();

            reader.onload = function(e) {
                imgPreview.src = e.target.result;
            }

            reader.readAsDataURL(image);
        }
    </script> --}}


    </div>
    </div>
</div>
