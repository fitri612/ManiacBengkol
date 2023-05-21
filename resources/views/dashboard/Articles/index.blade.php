@extends($user->is_admin ? 'layouts.admin' : 'layouts.app')

@section('content')
    <div class="container mx-auto px-5 py-4">
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
                                <a href="#"
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
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
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
                </aside> --}}
            </div>
        </div>
    </div>
@endsection
