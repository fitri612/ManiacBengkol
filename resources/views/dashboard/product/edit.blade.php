@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-5 py-4">
        <div class="max-w-3xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <form action="/product/{{ $products->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="p-6 space-y-6">
                    <div class="sm:col-span-3">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="mt-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
                                <input type="text" name="name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                                    value="{{ $products->name }}">
                                <div class="text-sm text-red-600">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                                <input type="number" name="price"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('price') is_invalid @enderror"
                                    value="{{ $products->price }}">
                                <div class="text-sm text-red-600">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                            <textarea type="text" name="description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('description') is_invalid @enderror">{{ $products->description }}</textarea>
                            <div class="text-sm text-red-600">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="mt-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                                <select name="category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($categories as $item)
                                        @if ($products->category_id == $item->id)
                                            <option value="{{ $item->id }}"selected>{{ $item->category_name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                                <input type="number" name="stock"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('stock') is_invalid @enderror"
                                    value="{{ $products->stock }}">
                                <div class="text-sm text-red-600">
                                    @error('stock')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            @if ($products->image)
                                <img class="img-preview " src="{{ asset('storage/' . $products->image) }}"
                                    style="max-width: 250px;max-height:250px;margin:0;">
                            @else
                                <img class="img-preview " style="max-width: 250px;max-height:250px;margin:0;">
                            @endif
                            <label class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('image') is_invalid @enderror"
                                value="{{ $products->image }}" onchange="previewImage()">
                            <div class="text-sm text-red-600">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Add
                        category</button>
                    <a href="{{ url('product') }}"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFRevent) {
                imgPreview.src = oFRevent.target.result;
            }
        }
    </script>
@endsection
