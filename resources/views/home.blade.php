@extends('base.main')
@section('title', 'Galleries')
@vite('resources/js/home.js')
@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            @if (isset($galleries) && $galleries->isNotEmpty())
            {{-- @dd($galleries) --}}
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    {{-- @dd($galleries) --}}
                    @foreach ($galleries as $gallery)
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src="{{ $gallery->main_image }}" alt="img" style="height: 400px; object-fit:cover;">
                                <div class="card-body">
                                    <p class="card-text">{{ $gallery->name }}</p>
                                    @auth

                                    <div class="d-flex justify-content-between align-items-center">
                                        @if($gallery->user_id === auth()->user()->id)
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-outline-secondary"
                                                    href="{{ route('view.gallery', ['id' => $gallery->id]) }}"
                                                    role="button">View</a>
                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('edit.gallery', ['id' => $gallery->id]) }}"
                                                    role="button">Edit</a>
                                            </div>
                                            {{-- <a class="btn btn-sm btn-outline-danger float-end" href="{{ route('edit.gallery', ['id' => $gallery->id]) }}" role="button">Delete</a> --}}
                                            <button type="button" class="btn btn-sm btn-outline-danger gallery-id-copy"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                gallery_id="{{ $gallery->id }}">
                                                Delete
                                            </button>
                                        @else
                                            <a class="btn btn-sm btn-outline-secondary"
                                            href="{{ route('view.gallery', ['id' => $gallery->id]) }}"
                                            role="button">View</a>
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                gallery_id="{{ $gallery->id }}">
                                                Comment
                                            </button>
                                        @endif
                                        </div>

                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h2 class="text-center text-danger">No Galleries Found</h2>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $galleries->links() }}
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you shure that you want to delete this gallery?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('delete.gallery', 'id') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" class="gallery-id-paste">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
