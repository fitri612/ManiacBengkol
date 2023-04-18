@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ url('articles/create') }}" class="btn btn-primary">Create Article</a>
                <div class="card">
                    <div class="card-header">{{ __('Article') }}</div>
                    {{-- buatkan tampilan artikel --}}
                    <div class="card-body">
                        <h2 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ratione sed
                            voluptate saepe accusamus sunt, veritatis necessitatibus consequatur vero alias similique!
                            Eligendi earum nobis sed delectus sit accusantium sapiente cumque?</p>
                        <p class="card-text"><small class="text-muted">Published on
                                2 Desember 2020</small></p>
                    </div>

                </div>
            </div>
        </div>
    @endsection
