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
                        <button
                            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:hidden sm:h-9 sm:w-9">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" stroke="currentColor" fill="none"
                                viewBox="0 0 24 24">
                                <circle cx="10.2" cy="10.2" r="7.2" stroke-width="1.5"></circle>
                                <path stroke-width="1.5" stroke-linecap="round" d="M21 21l-3.6-3.6"></path>
                            </svg>
                        </button>
                        <button
                            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M3 5.109C3 4.496 3.47 4 4.05 4h16.79c.58 0 1.049.496 1.049 1.109 0 .612-.47 1.108-1.05 1.108H4.05C3.47 6.217 3 5.721 3 5.11zM5.798 12.5c0-.612.47-1.109 1.05-1.109H18.04c.58 0 1.05.497 1.05 1.109s-.47 1.109-1.05 1.109H6.848c-.58 0-1.05-.497-1.05-1.109zM9.646 18.783c-.58 0-1.05.496-1.05 1.108 0 .613.47 1.109 1.05 1.109h5.597c.58 0 1.05-.496 1.05-1.109 0-.612-.47-1.108-1.05-1.108H9.646z">
                                </path>
                            </svg>
                        </button>
                        <button
                            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        User ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Note
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payment Method
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edit Status
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
                        <td class="px-6 py-4">
                            {{ $item->user_id }} ( {{ $item->name }} )
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
                            <span wire:poll.500ms="">{{ $item->transaction_status }}</span>
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->method_payment }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div style="display: flex; justify-content: center;">
                                @if (auth()->check() && auth()->user()->is_admin)
                                    <select wire:model="selectedStatus.{{ $item->id }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        {{-- <option selected>
                                    Change Status
                                    </option> --}}
                                        @foreach ($status as $stat)
                                            <option value="{{ $stat }}">{{ $stat }}</option>
                                        @endforeach
                                    </select>
                                    <div style="text-align: center; padding-top: 5px;">
                                        <button
                                            style="margin-left: 13px; background-color: #ffffff; color: white; padding: 9px 18px; border: 1px solid #ccc; border-radius: 10px; cursor: pointer; transition: background-color 0.3s ease; "
                                            onmouseover="this.style.backgroundColor='#ADD8E6'"
                                            onmouseout="this.style.backgroundColor='#ADD8E6'"
                                            wire:click="updateStatus({{ $item->id }})"><svg class="svg-icon"
                                                style="width: 24px; height: 24px;vertical-align: middle;fill: currentColor;overflow: hidden;"
                                                viewBox="0 0 1024 1024" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M165.840081 127.921872h608.774771l121.254934 121.254934v608.774771c0 20.834181-17.084028 37.91821-37.918209 37.918209H165.840081c-20.834181 0-37.91821-17.084028-37.918209-37.918209V165.840081c0-20.834181 17.084028-37.91821 37.918209-37.918209z"
                                                    fill="#01579B" />
                                                <path
                                                    d="M284.803255 127.921872h454.39349V318.76297c0 25.626043-20.834181 46.668566-46.668566 46.668566H331.471821c-25.626043 0-46.668566-20.834181-46.668566-46.668566V127.921872zM743.155239 896.078128H280.844761V654.818311c0-27.917803 22.709257-50.62706 50.62706-50.62706h361.2647c27.917803 0 50.62706 22.709257 50.62706 50.62706l-0.208342 241.259817z"
                                                    fill="#0277BD" />
                                                <path
                                                    d="M299.803866 127.921872h424.392268V318.76297c0 17.29237-14.167243 31.667955-31.667955 31.667956H331.471821c-17.29237 0-31.667955-14.167243-31.667955-31.667956V127.921872zM299.803866 896.078128h424.392268V654.818311c0-17.29237-14.167243-31.667955-31.667955-31.667955H331.471821c-17.29237 0-31.667955 14.167243-31.667955 31.667955v241.259817z"
                                                    fill="#EEEEEE" />
                                                <path d="M572.731638 127.921872h93.128789v181.882401h-93.128789z"
                                                    fill="#424242" />
                                                <path
                                                    d="M360.431333 724.612818h303.137334v19.167446H360.431333zM360.431333 808.991251h303.137334v19.167447H360.431333z"
                                                    fill="#757575" />
                                            </svg></button>
                                    </div>
                                @else
                                @endif
                            </div>
                            {{-- <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
