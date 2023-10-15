@extends('base.main')
@section('title', 'Gallery images')
@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            @if (isset($gallery))
                <div class="input-group input-group-lg pb-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Gallery name</span>
                    <input type="text" value="{{ $gallery[0]->name }}" class="gallery-name-copy ps-2 form-control"><a
                        class="btn btn-primary float-end" href="{{ route('view-gallery', ['id'=>$gallery[0]->id]) }}" role="button">&#8592; back</a>
                </div>

                <div class="input-group mb-1">
                    <span class="input-group-text">Cover Image:</span>
                    <input type="text" name="cover_image" class="form-control" class="gallery-name-copy"
                        value="{{ $gallery[0]->main_image }}">
                </div>

                <hr>
                {{-- @dd($gallery) --}}
                <form action="{{ route('update-gallery', ['id' => $gallery[0]->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $gallery[0]->name }}" name="gallery_name" class="gallery-name-paste">
                    <input type="hidden" value="{{ $gallery[0]->main_image }}" name="gallery_image" class="gallery-image-paste">

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
                                            <span class="input-group-text">URL:</span>
                                            <input type="text" id="image-url" name="image[]" class="form-control" required
                                                value="{{ $image->image }}">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="input-group mb-1">
                                                <span class="input-group-text">Image
                                                    position:</span>

                                                <input type="number" class="img-position form-control" id="position"
                                                    name="position[]" value="{{ $image->order_number }}">
                                            </div>
                                            <div class="btn-group mb-1">
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

            let container = document.querySelector('.injection--point');
            let addButton = document.querySelector('.add-gallery-btn');
            let imagesToBeDeleted = document.querySelector('#elementsToBeDeleted');

            let galleryNameCopy = document.querySelector('.gallery-name-copy');
            let galleryNamePaste = document.querySelector('.gallery-name-paste');


            let preparationForDelete = [];

            let deleteButtons = document.querySelectorAll('.delete-image');






            addButton.addEventListener('click', () => {
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

                deleteButtons.forEach((button, index) => {
                    totalimages = (index + 1);
                    button.addEventListener('click', executeBtn);
                });

            }

            function getTotalImages(image) {
                let totalImages = document.querySelectorAll('.img-position').length;
                image.totalImages = totalImages;
                return totalimages;
            }

            reloadButtons();

            galleryNameCopy.addEventListener('change', () => {
                galleryNamePaste.value = galleryNameCopy.value;
            });

            let image = `
                                    <div class="col">
                                        <div class="card shadow-sm">
                                            <img
                                            src="https://via.placeholder.com/640x480.png/003399?text=cats+Faker+enim"
                                            alt="img" />
                                            <div class="card-body">
                                            <div class="input-group mb-1">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                >URL:</span
                                                >
                                                <input
                                                type="text"
                                                id="image-url"
                                                name="image_new[]"
                                                class="form-control"
                                                value="" />
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="input-group mb-1">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    >Image position:</span
                                                >

                                                <input
                                                    type="number"
                                                    class="img-position form-control"
                                                    id="position"
                                                    name="position_new[]"
                                                    value="${getTotalImages(this)}" />
                                                </div>
                                                <div class="btn-group mb-1">
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-danger delete-image ms-1 outline-danger">
                                                    Delete
                                                </button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                          `;
        })
    </script>
@endsection
