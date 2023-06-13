<div>
    @include('partials.success_toast')
    {{-- <p class="text-lg font-bold text-gray-900 dark:text-white">Checkout</p> --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
  
        <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="flex items-center justify-between dark:text-white">
            <h2 class="text-2xl font-semibold">Checkout</h2>
            
          </div>
          <div class=" mt-3 flex items-center dark:text-white">
            <p class="text-sm text-gray-500 dark:text-gray-400">code : @if ($InvoiceCode)
              {{ $InvoiceCode->code_invoice }}
              @else
              @endif
            </p>
          </div>
          
          <hr class="my-4 border-t border-gray-300">
          @foreach ($transaction_detail as $detail)
          <div class=" mt-3 max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <div class="grid grid-cols-4 gap-4">
                <div class="flex items-center col-span-1">
                  
                <img src="{{ asset('storage/' . $detail->product->image) }}" class="h-20 w-20 rounded-md">
              </div>
              <div class="col-span-2">
                <h3 class="text-lg font-semibold">{{ $detail->product->name }}</h3>
                <p class="dark:text-gray-300">jumlah pesanan : {{ $detail->qty }}</p>
                <p class="dark:text-gray-300">Harga/pcs : {{ 'Rp ' . number_format($detail->price, 0, ',', '.') }}</p>
              </div>
              {{--  --}}
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
                  <span class="text-gray-700 dark:text-gray-400">Payment Method : </span>
                  <span class="font-semibold">{{ $latestTransaction->method_payment }}</span>
                </div>
                <div class="flex justify-between py-2">
                  <span class="text-gray-700 dark:text-gray-400">Subtotal ({{ $totalQty }})  items</span>
                  <span class="font-semibold">{{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-2">
                  <span class="text-gray-700 dark:text-gray-400">Tax estimate</span>
                  <span class="font-semibold">  0 </span>
                </div>
                <div class="flex justify-between border-t border-gray-300 py-2">
                  <span class="text-xl font-semibold">Order total</span>
                  <span class="text-xl font-semibold">{{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
                @if ($latestTransaction && $latestTransaction->method_payment === 'cash')
                  
                  <div class="border-t border-gray-300 py-2">
                    <p class="text-md">silahkan pergi ke bengkel langsung dan kirimkan kode berikut beserta nama ke whatsapp admin </p>
                    @if ($InvoiceCode)
                    <a href="#" style="display: flex;justify-content: center; background-color: rgb(0, 139, 254);border-radius:5px; padding: 10px;"  onclick="copyText()">  
                      <div style="justify-content: center; background-color: rgb(0, 139, 254);border-radius:5px; " class="flex">
                          <h2 id="text-to-copy" style="color: white">{{ $InvoiceCode->code_invoice }}</h2>
                            <button style="cursor: pointer; margin-left: 8px; color:white;padding-left:30px;"
                                class="fas fa-copy"></button>
                              </div>
                              </a>
                    @else
                    @endif

                    <p>whatsapp admin : 0854-7854-9082</p>
                  </div>
                @elseif ($latestTransaction && $latestTransaction->method_payment === 'transfer')
                <div class=" border-t border-gray-300 py-2">
                  <p>silahkan transfer ke salah satu rekening bank kami</p>
                  <table>
                    <tr>
                      <td class="pt-3 pr-4 pl-3">Dana</td>
                      <td class="pt-3 pr-4 pl-3">: 0812-5887-3943</td>
                    </tr>
                    <tr>
                      <td class="pt-3 pr-4 pl-3">Ovo </td>
                      <td class="pt-3 pr-4 pl-3">: 0812-5887-3943</td>
                    </tr>
                    <tr>
                      <td class="pt-3 pr-4 pl-3">Gopay </td>
                      <td class="pt-3 pr-4 pl-3">: 0812-5887-3943</td>
                    </tr>
                    <tr>
                      <td class="pt-3 pr-4 pl-3">BCA </td>
                      <td class="pt-3 pr-4 pl-3">: 089278 an parman</td>
                    </tr>
                  </table>
                  
                </div>
                  <p class="mt-2 mb-2 text-center text-md text-gray-500 dark:text-gray-400 font-semibold">upload bukti transfer</p>
                  
                  <input wire:loading.attr="disabled" wire:model="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file">
                  @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="Selected Image" height="300px" width="300px">
                  @endif
                  <p class="mt-2 text-sm  text-gray-400 dark:text-gray-400 ">tips* kamu bisa upload bukti pembayaran sekarang ataupun di menu riwayat transaksi loh</p>
                  <button {{-- wire:click="confirm_payment" --}} data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class=" mt-5 text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">confirm payment</button>
                  <div id="popup-modal" tabindex="-1" class="flex items-center justify-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                      <div class="relative w-full max-w-md max-h-full">
                          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                              <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                  <span class="sr-only">Close modal</span>
                              </button>
                              {{-- modal body --}}
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
                @endif
              </div>
            </div>
          </div>
        </div>
      
        
      
    </div> 
    <script>
      function copyText() {
          // Get the text content from the <h2> element
          var textToCopy = document.getElementById("text-to-copy").textContent;

          // Create a temporary input element
          var tempInput = document.createElement("input");
          tempInput.setAttribute("value", textToCopy);

          // Append the input element to the document
          document.body.appendChild(tempInput);

          // Select the text content
          tempInput.select();
          tempInput.setSelectionRange(0, 99999); // For mobile devices

          // Copy the text to the clipboard
          document.execCommand("copy");

          // Remove the temporary input element
          document.body.removeChild(tempInput);

          //   Alert or perform any desired action
          //   alert("Text copied: " + textToCopy);
      }
  </script>
    
</div>
