@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ url('articles/create') }}"
                    class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create
                    Article</a>
                <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
                    <div class="px-4 mx-auto max-w-screen-xl">
                        <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
                        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach ($articles as $item)
                                <article class="max-w-xs">
                                    <a href="#">
                                        <img src="{{ url('images/' . $item->image) }}" class="mb-5 rounded-lg"
                                            alt="Image 1">
                                    </a>
                                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                                        <a href="#">
                                            {{ $item->title }}
                                        </a>
                                    </h2>
                                    <p class="mb-4 font-light text-gray-500 dark:text-gray-400">
                                        {!! Str::limit($item->body, 100) !!}
                                    </p>
                                    <a href="{{ route('articles.show', $item) }}"
                                        class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                                        Detail
                                    </a>
                                    <a href="{{ route('articles.edit', $item->id) }}"
                                        class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('articles.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                                            Delete
                                        </button>
                                    </form>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
