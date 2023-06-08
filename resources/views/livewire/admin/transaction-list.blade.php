<div class="container mx-auto px-5 py-4">
    @include('partials.success_toast')


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="py-5" x-data="{ isSearchbarActive: false }"
            x-effect="$store.breakpoints.smAndUp &amp;&amp; (isSearchbarActive = false)">
            <div x-show="!isSearchbarActive" class="flex items-center justify-between">
                <div>
                    <div class="flex space-x-2">
                        <p class="text-xl font-medium text-slate-800 dark:text-navy-50">
                            History Transaksi Product
                        </p>
                    </div>
                    <p class="mt-1 text-xs"><?php echo date('l, M. j'); ?></p>

                </div>

                <div class="flex items-center space-x-2">
                    <label class="relative hidden sm:flex">
                        <input
                            class="form-input peer h-9 w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 text-xs+ placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="Search users..." type="text">
                    </label>
                    
                    <div class="flex">
                        <select wire:model="statusFilter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="all">Semua Satus</option>
                        <option value="done">Done</option>
                        <option value="rejected">Rejected</option>
                        <option value="pending">Pending</option>
                        
                        </select>

                    </div>
                </div>
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        trasaction id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        user id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        code invoice
                    </th>
                    <th scope="col" class="px-6 py-3">
                        total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        transaction note
                    </th>
                    <th scope="col" class="px-6 py-3">
                        status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        method payment
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getdata as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->id }}
                        </th>
                        <td class="px-6 py-4" >
                            {{ $item->user_id }}  {{ $item->name }} 
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->code_invoice }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->grand_total }}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $item->transaction_note) }}" alt="tf note" height="100px"
                                width="100px">
                        </td>
                        <td class="px-6 py-4">
                            {{-- <span wire:poll.500ms="">{{ $item->transaction_status }}</span> --}}
                            <span>{{ $item->transaction_status }}</span>
                            @if(auth()->check() && auth()->user()->is_admin)
                            <select wire:model="selectedStatus.{{ $item->id }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>
                                    Change Status
                                    </option>
                                @foreach ($status as $stat)
                                    <option value="{{ $stat }}">{{ $stat }}</option>
                                @endforeach
                            </select>
                            <button wire:click="updateStatus({{ $item->id }})">Save</button>
                            @else
                            {{-- <span>{{ $item->transaction_status }}</span> --}}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->method_payment }}
                        </td>
                        <td class="px-6 py-4 text-right">

                        <!-- Modal toggle -->
                        <button wire:click="showdata({{ $item->id }})" wire:loading.attr="disabled" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            show detail
                        </button>
                        
                        <!-- Main modal -->
                        <div id="defaultModal" wire:ignore.self tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            detail transaksi
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-2">
                                        @if ($transactionDetail)
                                        @foreach ($transactionDetail as $detail)
                                        <div  class=" mt-3 max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                            <div class="grid grid-cols-2 gap-2">
                                                <div class="flex items-center col-span-1">
                                                
                                                <img src="{{ asset('storage/' . $detail->image) }}" class="h-20 w-20 rounded-md">
                                            </div>
                                            <div class="col-span-1 space-y-2">
                                                <h3 class="text-lg font-semibold">{{ $detail->name }}</h3>
                                                <p class="">harga/pcs : {{ 'Rp ' . number_format($detail->price, 0, ',', '.') }}</p>
                                                <span class="p-2">jumlah pesanan : {{ $detail->qty }}</span>
                                            </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <h3 class="text-lg font-bold">Total Harga: {{ number_format($grandTotal, 0, ',', '.') }}</h3>
                                        
                                        @endif
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
  
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
