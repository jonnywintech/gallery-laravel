@extends('base.main')
@section('title', 'Galleries')
@section('content')

<div class="album py-5 bg-body-tertiary">
    <div class="container">

      @if(isset($galleries))
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        {{-- @dd($galleries) --}}
            @foreach ($galleries as $gallery )
            <div class="col">
              <div class="card shadow-sm">
               <img src="{{$gallery->main_image}}" alt="img">
                <div class="card-body">
                  <p class="card-text">{{$gallery->name}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-body-secondary">9 mins</small>
                  </div>
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
@endsection
