@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 card bg-dark text-white">
                <div class="card-header text-center">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row row-cols-6 justify-content-around">
                        <div class="col">
                            <a class="text-decoration-none" href="{{ route('admin.posts.index') }}">Post List</a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none" href="{{ route('admin.userIndex') }}">My posts</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
