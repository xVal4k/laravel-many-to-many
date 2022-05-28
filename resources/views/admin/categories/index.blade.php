@extends('layouts.admin')

@section('pageTitle', 'Index')

@section('pageMain')
    <div class="container text-center">
        <div class="row row-cols-4 g-4 py-5">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="card h-100" data-id="{{ $category->id }}">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h2 class="card-title">
                                <a class="text-decoration-none"
                                    href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a>
                            </h2>
                            <div class="row row-cols-3 justify-content-center">
                                <a class="btn btn-primary"
                                    href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                                <button class="btn btn-danger btn-delete">Delete</button>
                            </div>
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
                            <form method="POST" data-base="{{ route('admin.categories.destroy', '***') }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
            </section>
        </div>

        {{ $categories->links() }}
    </div>
@endsection
