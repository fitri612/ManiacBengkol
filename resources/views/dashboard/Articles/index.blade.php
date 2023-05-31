@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-5 py-4">
        <div class="py-5" x-data="{ isSearchbarActive: false }"
            x-effect="$store.breakpoints.smAndUp &amp;&amp; (isSearchbarActive = false)">
            <div x-show="!isSearchbarActive" class="flex items-center justify-between">
                <div>
                    <div class="flex space-x-2">
                        <p class="text-xl font-medium text-slate-800 dark:text-navy-50">
                            Article Management
                        </p>
                    </div>
                    <p class="mt-1 text-xs"><?php echo date('l, M. j'); ?></p>
                </div>
                <div class="flex items-center space-x-2">
                    <label class="relative hidden sm:flex">
                        <input
                            class="form-input peer h-9 w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 text-xs+ placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="Search users..." type="text">
                    </label>
                    <div class="flex">
                        <button
                            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:hidden sm:h-9 sm:w-9">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" stroke="currentColor" fill="none"
                                viewBox="0 0 24 24">
                                <circle cx="10.2" cy="10.2" r="7.2" stroke-width="1.5"></circle>
                                <path stroke-width="1.5" stroke-linecap="round" d="M21 21l-3.6-3.6"></path>
                            </svg>
                        </button>
                        <button
                            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M3 5.109C3 4.496 3.47 4 4.05 4h16.79c.58 0 1.049.496 1.049 1.109 0 .612-.47 1.108-1.05 1.108H4.05C3.47 6.217 3 5.721 3 5.11zM5.798 12.5c0-.612.47-1.109 1.05-1.109H18.04c.58 0 1.05.497 1.05 1.109s-.47 1.109-1.05 1.109H6.848c-.58 0-1.05-.497-1.05-1.109zM9.646 18.783c-.58 0-1.05.496-1.05 1.108 0 .613.47 1.109 1.05 1.109h5.597c.58 0 1.05-.496 1.05-1.109 0-.612-.47-1.108-1.05-1.108H9.646z">
                                </path>
                            </svg>
                        </button>
                        <button
                            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ url('articles/create') }}"
                    class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create
                    Article</a>
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
