@extends('layouts.admin')

@section('content')
<div class="max-w-3xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <form action="/booking-admin/{{$bookings->id}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="p-6 space-y-6">
            <h3>Bayar Booking</h3>
            <div class="sm:col-span-3">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-2">
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Nama Pengguna</label>
                        <input type="text" name="user_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                         value="{{  $bookings->user->name}}" disabled>
                         {{-- inputan-status-booking --}}
                         <input type="text" name="status_booking" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                         value="Lunas"  style="display:none;">
                         {{-- inputan-status-booking-end --}}

                    </div>
                    <div class="mt-2">
                        <label  class="block text-sm font-medium leading-6 text-gray-900">service</label>
                        <input type="text" name="service" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('price') is_invalid @enderror"
                        value="Motor" disabled>
                        <div class="text-sm text-red-600">
                            @error('service')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <label  class="block text-sm font-medium leading-6 text-gray-900">Keluhan</label>
                    <textarea type="text" name="note" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('description') is_invalid @enderror" disabled>{{$bookings->note}}</textarea>
                    <div class="text-sm text-red-600" >
                        @error('note')
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">

                    <div class="mt-2">
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Nomor Polisi</label>
                        <input type="text" name="nopol" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                         value="{{$bookings->nopol}}"disabled >
                        <div class="text-sm text-red-600">
                            @error('nopol')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                
                    <div class="mt-2">
                        <label  class="block text-sm font-medium leading-6 text-gray-900">tanggal dan jam boking</label>
                        <input type="datetime-local" name="jam_kedatangan" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('stock') is_invalid @enderror"
                        value="{{$bookings->jam_kedatangan}}" disabled>
                        <div class="text-sm text-red-600">
                            @error('jam_kedatangan')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="mt-2 ">
                          <div class="grid grid-cols-2 gap-2">
                                <div class="mt-2">
                                    <label  class="block text-sm font-medium leading-6 text-gray-900">Harga Service</label>
                                    <input type="number" onkeyup="sum()" id="harga_service" name="total_service" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                                    value="">
                                    <div class="text-sm text-red-600">
                                        @error('total_service')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label  class="block text-sm font-medium leading-6 text-gray-900">Cash | Bayar</label>
                                    <input type="number" id="total_cash" onkeyup="sum()" name="total_cash" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                                    value="">
                                    <div class="text-sm text-red-600">
                                        @error('total_cash')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>                            

                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                {{-- input-kembalian-ke-database --}}
                                    <input type="number" id="kembalian2" onkeyup="sum()" name="kembalian"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('stock') is_invalid @enderror"
                                    value="" style="display:none;">
                                {{-- input-kembalian-ke-database-end --}}

                                {{-- tampilan-input-kembalian-ke-database --}}
                                <div class="mt-2">
                                    <label  class="block text-sm font-medium leading-6 text-gray-900">Kembalian</label>
                                    <input type="number" id="kembalian" onkeyup="sum()"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('stock') is_invalid @enderror"
                                    value="" disabled>
                                    <div class="text-sm text-red-600">
                                        @error('kembalian')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                                {{-- tampilan-input-kembalian-ke-database-end --}}
                            </div>
                    </div>
                    <div id="extra_product"></div>
                </div>

            </div>

                <button  type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Bayar</button>
                <a href="{{url('/booking-admin')}}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Back
                </a>
        </div>
    </form>
</div>

@endsection

    <script>
        function sum(){
            var NumberValue1= document.getElementById('harga_service').value;
            var NumberValue2= document.getElementById('total_cash').value;
            var result = parseInt(NumberValue2) - parseInt(NumberValue1);

            if(!isNaN(result)){
                document.getElementById('kembalian').value=result;
            } 
            if(!isNaN(result)){
                document.getElementById('kembalian2').value=result;
            } 
        }
    </script>

