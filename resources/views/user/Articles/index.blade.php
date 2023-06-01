@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-4 grid grid-cols-1 gap-4 sm:mt-5 sm:grid-cols-3 sm:gap-5 lg:mt-6 lg:gap-6">
                    @foreach ($articles as $item)
                        <div class="card p-2 pb-3">
                            <div class="relative w-full">
                                <img class="h-56 w-full rounded-xl object-cover object-center"
                                    src="{{ url('images/' . $item->image) }}" alt="image" />
                            </div>
                            <div class="mx-2 mt-3">
                                <a href="{{ route('articles.show', $item) }}"
                                    class="mt-1.5 text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                                    {{ $item->title }}
                                </a>
                                <div class="mt-2 flex items-center justify-between">
                                    <p class="text-xs text-slate-400 dark:text-navy-300">
                                        {{ $item->created_at->diffForHumans() }}
                                    </p>
                                    <p>
                                        <span class="font-semibold text-slate-700 dark:text-navy-100">
                                            <i class="fa-brands fa-ethereum text-sm+"></i>
                                            5.01
                                        </span>
                                        <span class="text-slate-400 dark:text-navy-300">ETH</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
