@extends('layouts.admin')

@section('pageTitle', 'New Post')

@section('pageMain')
    <div class="container py-5">
        <div class="row justify-content-center text-white">
            <div class="col-8">
                <form method="POST" action="{{ route('admin.posts.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    </div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="5" name="content">{{ old('content') }}</textarea>
                    </div>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <fieldset>
                            <p>Tags</p>
                            @foreach ($tags as $tag)
                                <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}"
                                    value="{{ $tag->id }}" @if (in_array($tag->id, old('tags', []))) checked @endif>
                                <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                            @endforeach
                        </fieldset>
                    </div>
                    @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="text" class="form-control" id="image" name="image" value="{{ old('image') }}">
                    </div>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="category_id" id="category">
                            <option value="">Select a category</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                        <button type="button" class="btn btn-primary slug_btn mt-3">Generate slug</button>
                    </div>
                    @error('slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row text-center">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
