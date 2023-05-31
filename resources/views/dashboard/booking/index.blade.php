@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

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
                                        Nomor Polisi
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
                                    <tbody>    
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $item->user->name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $item->nopol }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $item->note }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $item->jam_kedatangan}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $item->status_booking }}
                                                </td>
                                                    
                                                <td class="px-6 py-4">
                                                    @if ($item->status_booking == 'Lunas')
                                                        <p>Terbayar</p>
                                                    @else
                                                        <a href="/booking-admin/{{$item->id }}/edit"
                                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-full hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-3">
                                                            Bayar
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                    <form action="/booking-admin/{{$item->id}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button  type="submit" onclick="return confirm('Hapus Data ?')"  class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Hapus</button>

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
