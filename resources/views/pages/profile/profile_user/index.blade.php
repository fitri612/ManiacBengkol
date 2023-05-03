@extends('layouts.app')

@section('content')
@if (Session::has('update'))
<div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-800 dark:text-blue-400" role="alert">
    <p>Update Profile Successfully</p>
</div>

@endif

<div class="max-w-3xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <form action="{{route('profile_update')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="p-6 space-y-6">
            <div class="sm:col-span-3">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-2">
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <input type="text" name="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                         value="{{$user->name}}">
                        <div class="text-sm text-red-600">
                            @error('name')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2">
                        <label  class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <input type="email" name="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is_invalid @enderror"
                         value="{{$user->email}}">
                        <div class="text-sm text-red-600">
                            @error('email')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <label  class="block text-sm font-medium leading-6 text-gray-900">Profile Image</label>
                    @if ($user->image_profile)
                    <img class="img-preview " src="{{asset('storage/'.$user->image_profile)}}" style="max-width: 250px;max-height:250px;margin:0;">                        
                    @else    
                    <img class="img-preview " src="{{asset('img/profile.png')}}" style="max-width: 250px;max-height:250px;margin:0;">                        
                    <img class="img-preview " style="max-width: 250px;max-height:250px;margin:0;">
                    @endif
                    <label  class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                    <input type="file" id="image" name="image_profile" accept="image/*" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('image') is_invalid @enderror" value="{{$user->image_profile}}"
                    onchange="previewImage()">
                    <div class="text-sm text-red-600">
                        @error('image_profile')
                            {{$message}}
                        @enderror
                    </div>

                </div>
            </div>

                <button  type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Edit Profile</button>
                <a href="{{url('/home')}}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Back
                </a>
        </div>
    </form>
</div>

<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFRevent){
            imgPreview.src = oFRevent.target.result;
        }
    }
</script>

@endsection
