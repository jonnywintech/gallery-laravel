@extends('base.main')
@section('title', 'Preview Gallery')
@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            @if (isset($gallery))
            <h1>Gallery - {{$gallery[0]->name}} <a class="btn btn-primary float-end" href="{{route('edit-gallery',['id'=>$gallery[0]->id])}}" role="button">Edit</a></h1>
            <hr>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 injection--point">
                        @foreach ($gallery[0]->images as $image)
                            <div class="col">
                                <input type="hidden" name="image_id[]" class="image_id" value="{{ $image->id }}">
                                <div class="card shadow-sm">
                                    <img src="{{ $image->image }}" alt="img">
                                    <div class="card-body">
                                        <div class="input-group input-group mb-1">
                                            <span class="input-group-text" id="inputGroup-sizing-default">URL:</span>
                                            <input type="text" name="image[]" value="{{ $image->image }}" class="form-control" readonly>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group align-items-center mt-2 input-group input-group mb-1">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Image position</span>
                                                <input type="number" class="form-control" readonly
                                                    style="width: 6rem;" id="position" name="postiion[]"
                                                    value="{{ $image->order_number }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

            @else
                <h2 class="text-center text-danger">No Images Found</h2>
            @endif
        </div>
    </div>
    {{-- <div class="d-flex justify-content-center">
    {{ $images->links() }}
</div> --}}
@endsection
