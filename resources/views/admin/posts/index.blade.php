@extends('layouts.admin')

@section('pageTitle', 'Index')

@section('pageMain')
    <div class="container text-center">

        @if (Route::currentRouteName() == 'admin.posts.index')
            <form action="" method="get" class="row g-3 mb-3">

                <div class="col-md-10">
                    <label for="search_str" class="form-label"></label>
                    <input type="text" class="form-control" id="search_str" name="search_str"
                        value="{{ $request->search_str }}" placeholder="Search String">
                </div>

                <div class="col-md-6">
                    <select class="form-select" aria-label="Default select example" name="category" id="category">
                        <option value="" selected>Select a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $request->category == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary">Filter</button>
                </div>

            </form>
        @endif

        <div class="row row-cols-4 g-4 py-5">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card h-100" data-id="{{ $post->slug }}">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h2 class="card-title">
                                <a class="text-decoration-none"
                                    href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            @if (Auth::user()->id == $post->user_id)
                                <div class="row row-cols-3 justify-content-center">
                                    <div class="col">
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                                    </div>
                                    <div class="col" data-id="{{ $post->slug }}">

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger del_btn" data-bs-toggle="modal"
                                            data-bs-target="#modal-delete">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Modal -->
            <section class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body text-dark">
                            Please confirm your choice
                        </div>
                        <div class="modal-footer">
                            <button type="button md_close_btn" class="btn btn-secondary "
                                data-bs-dismiss="modal">Close</button>
                            <form method="POST" data-base="{{ route('admin.posts.destroy', '***') }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
            </section>
        </div>

        {{ $posts->links() }}
        <h3 class="my-4">
            <a class="text-decoration-none" href="{{ route('admin.posts.create') }}">Add new post</a>
        </h3>
        <h3 class="my-4">
            <a class="text-decoration-none" href="{{ route('admin.home') }}">Home</a>
        </h3>
    </div>
@endsection
