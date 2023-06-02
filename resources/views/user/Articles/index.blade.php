@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-4 grid grid-cols-1 gap-4 sm:mt-5 sm:grid-cols-3 sm:gap-5 lg:mt-6 lg:gap-6">
                    @foreach ($articles as $item)
                    <article class="flex max-w-xl flex-col items-start justify-between bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center gap-x-4 text-xs">
                            <time datetime="2020-03-16" class="text-gray-500">
                                {{ $item->created_at->format('d M Y') }}
                            </time>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="{{ route('articles.show', $item) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                {{ $item->body }}
                            </p>
                        </div>
                        <div class="relative mt-8 flex items-center gap-x-4">
                            <img src="{{ asset('img/creator_article.jpg') }}"
                            alt="" class="h-10 w-10 rounded-full bg-gray-50">
                            <div class="text-sm leading-6">
                                <p class="font-semibold text-gray-900">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        {{ $item->author }}
                                    </a>
                                </p>
                                <p class="text-gray-600">Creator</p>
                            </div>
                        </div>
                    </article>
                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
