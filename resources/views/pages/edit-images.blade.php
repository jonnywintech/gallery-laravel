@extends('base.main')
@section('title', 'Gallery images')
@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            @if (isset($gallery))
                <h1>Gallery - <input type="text" value="{{ $gallery[0]->name }}" class="gallery-name-copy ps-2"
                        style="background-color: transparent;"><a class="btn btn-primary float-end" href="{{url()->previous()}}" role="button">&#8592; back</a>
                </h1>
                <hr>
                {{-- @dd($gallery) --}}
                <form action="{{ route('update-gallery', ['id' => $gallery[0]->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $gallery[0]->name }}" name="gallery_name" class="gallery-name-paste">

                    <input type="hidden" name="elementsToBeDeleted" id="elementsToBeDeleted">
                    <button type="button" class="btn btn-success my-2 add-gallery-btn">+ add new</button>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 injection--point">
                        @foreach ($gallery[0]->images as $image)
                            {{-- @dd($image) --}}
                            <div class="col">
                                <input type="hidden" name="image_id[]" class="image_id" value="{{ $image->id }}">
                                <div class="card shadow-sm">
                                    <img src="{{ $image->image }}" alt="img">
                                    <div class="card-body">
                                        <div class="input-group mb-1">
                                            <span class="input-group-text" id="inputGroup-sizing-default">URL:</span>
                                            <input type="text" id="image-url" name="image[]" class="form-control"
                                                value="{{ $image->image }}">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Image
                                                    position:</span>
                                                <input type="number" class="img-position form-control" style="width: 6rem;"
                                                    id="position" name="postiion[]" value="{{ $image->order_number }}">
                                            </div>
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger delete-image ms-1 outline-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="mt-3 btn btn-primary float-end" type="submit">Save changes</button>
                </form>
            @else
                <h2 class="text-center text-danger">No Galleries Found</h2>
            @endif
        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener('load', function() {

            const container = document.querySelector('.injection--point');
            const addButton = document.querySelector('.add-gallery-btn');
            let imagesToBeDeleted = document.querySelector('#elementsToBeDeleted');

            let galleryNameCopy = document.querySelector('.gallery-name-copy');
            let galleryNamePaste = document.querySelector('.gallery-name-paste');


            let preparationForDelete = [];

            let deleteButtons = document.querySelectorAll('.delete-image');
            let imagesPositions = document.querySelectorAll('.img-position');
            let totalimages = imagesPositions.length + 1;

            let image = `<div class="col">
                    <div class="card shadow-sm">
                        <img src="" alt="img">
                        <div class="card-body">
                            <label for="image-url">URL:</label>
                            <input type="text" value="" name="image_new[]">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group align-items-center mt-2">
                                    <label class="me-2" for="position">Image postition</label>
                                    <input type="number" class="form-control" style="width: 6rem;"
                                        id="position" class="img-position" name="postiion_new[]" value="${totalimages}">
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-danger
                                    delete-image ms-1 outline-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;

            addButton.addEventListener('click', () => {
                totalimages = document.querySelectorAll('.img-position').length + 1;
                container.insertAdjacentHTML('afterbegin', image);
                // update delete buttons
                reloadButtons();
            })

            const executeBtn = (element) => {
                const topElement = element.currentTarget.parentElement.parentElement.parentElement.parentElement
                    .parentElement;
                if (topElement.querySelector('.image_id')) {
                    let imageId = topElement.querySelector('.image_id').value;
                    preparationForDelete.push(imageId);
                    imagesToBeDeleted.value = JSON.stringify(preparationForDelete);
                }
                topElement.remove();
            };

            function reloadButtons() {

                // it clean excess  event listeners when new image is created
                deleteButtons = document.querySelectorAll('.delete-image');

                deleteButtons.forEach((button) => {
                    button.removeEventListener('click', executeBtn)
                });

                deleteButtons.forEach((button) => {
                    button.addEventListener('click', executeBtn);
                });

            }


            reloadButtons();

            galleryNameCopy.addEventListener('change', () => {
                galleryNamePaste.value = galleryNameCopy.value;
            });
        })
    </script>
@endsection
