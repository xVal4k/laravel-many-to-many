@extends('layouts.admin')

@section('pageTitle', $post->title)

@section('pageMain')
    <div class="container py-5 text-center">
        <div class="row g-4">
            <div class="col">
                <img src="{{ $post->image }}" alt="{{ $post->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <h4 class="my-4"><a class="text-decoration-none" href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a></h4>

            </div>
        </div>
        <div class="container py-5 text-center">
            <h3 class="my-4"><a class="text-decoration-none" href="{{ route('admin.posts.index') }}">Posts List</a></h3>
        </div>
    </div>
@endsection
