@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (Session::has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <p>Create Product Successfully</p>
                </div>
                
            @endif
            @if (Session::has('update'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-800 dark:text-blue-400" role="alert">
                    <p>Update Product Successfully</p>
                </div>
                
            @endif
            @if (Session::has('delete'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <p>Delete Product Successfully</p>
                </div>
                
            @endif
            <div class="col-md-8">
                    {{-- modal create --}}
                    <a href="{{url('product/create')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-full hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-3">
                        Create product
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
                                        Image Product
                                   </th>
                                    <th scope="col" class="px-6 py-3">
                                         Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stock
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Update
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($products as $item)
                                
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$loop->iteration}}
                                    </th>
                                    <td class="px-6 py-4">
                                        
                                            <img src="{{asset('storage/'.$item->image)}}" style="max-width: 70px;height:70px;margin:0;object-fit: cover;" alt="">
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        {{$item->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->price}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->description}}                                        
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->stock}}                                        
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->category->category_name}}                                        
                                    </td>
                                    <td class="px-6 py-4 ">
                                        <a href="/product/{{$item->id}}/edit ">    
                                            <button  class=" text-white bg-blue-700 hover:bg-red-800   rounded-full text-sm px-4 py-2" type="button">
                                            Update
                                        </button>
                                        </a>
                    

                                    </td>
                                    <td>

                                        <form action="/product/{{$item->id}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button  class=" text-white bg-blue-700 hover:bg-red-800   rounded-full text-sm px-4 py-2 " type="submit">
                                                Delete
                                            </button>
                                            </form>
                        
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
    <!-- Main modal create -->
    {{-- <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Insert Category Name
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{url('product')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-6">
                    <div class="sm:col-span-3">
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
                        <div class="mt-2">
                          <input type="text" name="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror">
                        </div>
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                        <div class="mt-2">
                          <input type="number" name="price" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('price') is_invalid @enderror">
                        </div>
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                          <input type="text" name="description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('description') is_invalid @enderror">
                        </div>
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                        <div class="mt-2">
                          <input type="number" name="stock" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('stock') is_invalid @enderror">
                        </div>
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                        <select  name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($categories as $item)
                            @if (old('category_id') == $item->id)
                            <option value="{{$item->id}}"selected>{{$item->category_name}}</option>
                            @else
                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                            @endif
                            @endforeach
                           </select>                                                               
                        <div class="mt-2">
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                          <input type="file" name="image" accept="image/*" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('image') is_invalid @enderror">
                        </div>
                    </div>
                          <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add category</button>
                </div>
            </form>
        </div>
       </div>
    </div> --}}
                    
                </div>
            </div>
        </div>
    @endsection
