@extends('layouts.app')

@section('content')

<!-- Modal toggle -->
{{-- <button data-modal-target="large-modal" data-modal-toggle="large-modal" class="block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Large modal
  </button>

<!-- Main modal -->
<div id="large-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-4xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
              <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                  Large modal
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div  class=" mt-3 max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:text-white">
              <div class="grid grid-cols-4 gap-4">
                  <div class="flex items-center col-span-1">
                  
                  <img src="../img/avataritem.png" class="h-20 w-20 rounded-md">
                </div>
                <div class="col-span-2">
                  <h3 class="text-lg font-semibold">name</h3>
                  <p class="text-gray-500">9900</p>
                </div>
                <div class="flex items-center col-span-1">
                  <div class="custom-number-input h-10 w-32">
                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                      
                      <span class="p-2">jumlah pesanan : 2</span>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
          </div>
          <!-- Modal footer -->
          <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
              <button data-modal-hide="large-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
              <button data-modal-hide="large-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
          </div>
      </div>
  </div>
</div> --}}
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
  
  <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between dark:text-white">
      <h2 class="text-2xl font-semibold">Transaction Detail</h2>
    </div>
    
    
    <hr class="my-4 border-t border-gray-300">
    @foreach ($transaction_detail as $detail)
    <div class=" mt-3 max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:text-white">
      <div class="grid grid-cols-4 gap-4">
          <div class="flex items-center col-span-1">
            
          <img src="{{ asset('storage/' . $detail->product->image) }}" class="h-20 w-20 rounded-md">
        </div>
        <div class="col-span-2">
          <h3 class="text-lg font-semibold">{{ $detail->product->name }}</h3>
          <p class="text-gray-500">jumlah pesanan : {{ $detail->qty }}</p>
          <p class="text-gray-500">Harga/pcs : {{ $detail->price }}</p>
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
            <span class="text-gray-700 dark:text-gray-400">Subtotal ({{ $totalQty }}) items</span>
            <span class="font-semibold">{{ $totalPrice  }}</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-gray-700 dark:text-gray-400">Tax estimate</span>
            <span class="font-semibold">  0 </span>
          </div>
          <div class="flex justify-between border-t border-gray-300 py-2">
            <span class="text-xl font-semibold">Order total</span>
            <span class="text-xl font-semibold">{{ $totalPrice  }}</span>
          </div>
        </div>
      </div>
    </div>
    
  </div>

  

</div> 

@endsection