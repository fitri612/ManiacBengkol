@extends('layouts.app')

@section('content')
    <div class="max-w-3xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto">
        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <p>Create Booking Successfully</p>
            </div>
        @endif
        <form action="{{ url('booking') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-6">
                <div class="sm:col-span-3">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Nama Pengguna</label>
                            <input type="text" name="user_name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                                value="{{ Auth::user()->name }}" disabled>
                            <input type="text" name="status_booking"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                                value="belum bayar" style="display:none;">

                            <input type="text" name="user_id"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                                value="{{ Auth::user()->id }}" style="display:none;">
                            <div class="text-sm text-red-600">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">service</label>
                            <input type="text" name="service"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('price') is_invalid @enderror"
                                value="Motor" disabled>
                            <div class="text-sm text-red-600">
                                @error('service')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Keluhan</label>
                        <textarea type="text" name="note"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('description') is_invalid @enderror">{{ old('note') }}</textarea>
                        <div class="text-sm text-red-600">
                            @error('note')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">

                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Nomor Telfon</label>
                            <input type="text" name="nopol"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                                value="{{ old('nopol') }}">
                            <div class="text-sm text-red-600">
                                @error('nopol')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">tanggal dan jam boking</label>
                            <input type="datetime-local" name="jam_kedatangan"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('stock') is_invalid @enderror"
                                value="{{ old('jam_kedatangan') }}">
                            <div class="text-sm text-red-600">
                                @error('jam_kedatangan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">

                    </div>

                </div>

                <button type="submit"
                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Tambah
                    Booking</button>
                <a href="{{ url('home') }}"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Back
                </a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    {{-- <script>
        const add = document.querySelectorAll(".tambah_group .add_product")
        add.forEach(function(e) {
            e.addEventListener('click',function(){
                let element = this.parentElement
                console.log(element);
                let newElement= document.createElement('div')
                newElement.classList.add('tambah_group','relative','mb-4','flex','flex-wrap','items-stretch')
                newElement.innerHTML =
                `
                            <select name="product_id[]"
                                class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                                placeholder="Recipient's username"
                                aria-label="Recipient's username"
                                aria-describedby="button-addon2" >
                                <option value=""selected>silahkan pilih produk</option>
                                @foreach ($products as $item)
                                @if (old('product_id') == $item->id)
                                <option value="{{$item->id}}"selected>{{$item->name}} | Rp. {{number_format($item->price,2)}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}} | Rp. {{number_format($item->price,2)}}</option>
                                @endif
                                @endforeach
                            </select>
                           
                            <button
                              class="remove_product z-[2] inline-block rounded-r bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out bg-red-700 hover:bg-red-800"
                              data-te-ripple-init
                              type="button"
                              id="button-addon2">
                              Hapus produk
                            </button>`
                            document.getElementById('extra_product').appendChild(newElement)

                            document.querySelectorAll('.remove_product').forEach(function(remove){
                                remove.addEventListener('click',function(elmClick){
                                    elmClick.target.parentElement.remove()
                                })
                            })
            })
        })
    </script> --}}
@endpush
