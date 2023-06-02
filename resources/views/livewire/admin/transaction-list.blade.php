
<div class="container mx-auto px-5 py-4">
    @include('partials.success_toast')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                
            </tr>
        </thead>
        <tbody>
            @foreach ($getdata as $item)
                
            
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->id }}
                </th>
                <td class="px-6 py-4">
                    {{ $item->id }} ( {{ $item->name }} )
                </td>
                <td class="px-6 py-4">
                    {{ $item->code_invoice }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->grand_total }}
                </td>
                <td class="px-6 py-4">
                    <img src="{{ asset('storage/' . $item->transaction_note) }}" alt="bukti pembayaran belum di upload" height="100px" width="100px">
                </td>
                <td class="px-6 py-4">
                    <span wire:poll.100ms>{{ $item->transaction_status }}</span>
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
                    @endif
                </td>
                <td class="px-6 py-4">
                    {{ $item->method_payment }}
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>

