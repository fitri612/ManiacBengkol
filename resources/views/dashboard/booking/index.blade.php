@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-5 py-4">
        <div class="row justify-content-center">
            <div class="py-5" x-data="{ isSearchbarActive: false }"
                x-effect="$store.breakpoints.smAndUp &amp;&amp; (isSearchbarActive = false)">
                <div x-show="!isSearchbarActive" class="flex items-center justify-between">
                    <div>
                        <div class="flex space-x-2">
                            <p class="text-xl font-medium text-slate-800 dark:text-navy-50">
                                Booking
                            </p>
                        </div>
                        <p class="mt-1 text-xs"><?php echo date('l, M. j'); ?></p>

                    </div>

                    <div class="flex items-center space-x-2">
                        <label class="relative hidden sm:flex">
                            <input
                                onkeyup="searchByName()"
                                id="searchInput"
                                class="form-input peer h-9 w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 text-xs+ placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Search booking ..." type="text">
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
            @if (Session::has('update'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-800 dark:text-blue-400"
                    role="alert">
                    <p>Pembayaran Berhasil</p>
                </div>
            @endif
            @if (Session::has('delete'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <p>Hapus Data Berhasil</p>
                </div>
            @endif
            <div class="col-md-8">



                <div class="card">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nomor Telfon
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Keluhan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jadwal Booking
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status Booking
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Bayar
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Hapus
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($bookings as $item)
                                <tbody class="tabel-produk">
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4 nama">
                                            {{ $item->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->nopol }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->note }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->jam_kedatangan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->status_booking }}
                                        </td>

                                        <td class="px-6 py-4">
                                            @if ($item->status_booking == 'Lunas')
                                                <p>Terbayar</p>
                                            @else
                                                <a href="/booking-admin/{{ $item->id }}/edit"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-full hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-3">
                                                    Bayar
                                                </a>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="/booking-admin/{{ $item->id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" onclick="return confirm('Hapus Data ?')"
                                                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Hapus</button>

                                            </form>
                                        </td>

                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    @endsection
