@extends('base.main')
@section('title', 'Preview Gallery')
@vite('resources/js/swiperJs.js')
@vite('resources/css/app.css')
@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            @if (isset($gallery))
                <h1>Gallery - {{ $gallery[0]->name }}
                    @if (auth()->user()->id == $gallery[0]->id)
                        <a class="btn btn-primary float-end" href="{{ route('edit.gallery', ['id' => $gallery[0]->id]) }}"
                            role="button">Edit</a>
                    @endif
                </h1>
                <hr>
                <div class="container pt-5">
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($gallery[0]->images as $image)
                                <div class="swiper-slide">
                                    <img class="swiper__image" src="{{ $image->image }}" alt="">
                                </div>
                            @endforeach
                            ...
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                    </div>
                </div>
            @else
                <h2 class="text-center text-danger">No Images Found</h2>
            @endif
        </div>
    </div>

    <div class="comments">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">
                        <div class="form-outline mb-4">
                            <form method="POST" action="{{ route('create.comment', ['id' => $gallery[0]->id]) }}">
                                @csrf
                                <input type="text" name="comment" id="addANote" class="form-control"
                                    placeholder="Type comment..." />
                                <label class="form-label" for="addANote"><button class="btn" type="submit"
                                        role="button" style="text-decoration: none" href="">+ Add a
                                        note</button></label>
                            </form>
                        </div>
                        @foreach ($comments as $comment)
                            <div class="card {{ $loop->last ? 'mb-4' : '' }}">
                                <div class="card-body">
                                    <p>{{ $comment->comments[0]->comment }}</p>

                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp"
                                                alt="avatar" width="25" height="25" />
                                            <p class="small mb-0 ms-2">
                                                {{ $comment->user->first_name . ' ' . $comment->user->last_name }}</p>
                                        </div>
                                        {{-- @dd($comment) --}}
                                        <div class="d-flex flex-row align-items-center">
                                            <form method="POST"
                                                action="
                                            {{ route('delete.comment', ['gallery_id' => $gallery[0]->id, 'comment_id' => $comment->comments[0]->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="comment_id" value="{{ $comment->comments[0]->id }}">
                                                <input type="hidden" name="user_comment_id" value="{{ $comment->id }}">

                                                <p class="small text-danger mb-0"><button
                                                    @disabled(auth()->user()->id !== $gallery[0]->user_id)
                                                    type="submit" class="btn">Delete</button></p>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
@endsection
