@if(auth()->check() && auth()->user()->is_admin)
    
    @include('vendor.chatify.pages.admin')
    
@else
    @extends('layouts.app')
        @unless(View::hasSection('exclude-scripts'))
            <script src="{{ asset('js/control.js') }}" defer></script>
        @endunless

        @unless(View::hasSection('exclude-styles'))
            <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
        @endunless
    @section('content')
        @include('vendor.chatify.pages.customer')
    @endsection

@endif