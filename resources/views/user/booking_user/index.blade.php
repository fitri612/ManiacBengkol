@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (Session::has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <p>Create Product Successfully</p>
                </div>
            @endif
            @if (Session::has('update'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-800 dark:text-blue-400"
                    role="alert">
                    <p>Update Product Successfully</p>
                </div>
            @endif
            @if (Session::has('delete'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <p>Delete Product Successfully</p>
                </div>
            @endif
            <div class="col-md-8">
                {{-- modal create --}}
                <a href="{{ url('booking/create') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-full hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-3">
                    Booking Jadwal
                </a>

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

                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
