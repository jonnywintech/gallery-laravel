@extends('base.main')
@section('title', 'Gallery images')
@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            @if (isset($gallery))
                <form action="{{ route('edit-gallery', ['id' => $gallery[0]->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="elementsToBeDeleted" id="elementsToBeDeleted">
                    <button type="button" class="btn btn-success my-2 add-gallery-btn">+ add new</button>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 injection--point">
                        @foreach ($gallery[0]->images as $image)
                            {{-- @dd($image) --}}
                            <div class="col">
                                <input type="hidden" name="image_id" class="image_id" value="{{ $image->id }}">
                                <div class="card shadow-sm">
                                    <img src="{{ $image->image }}" alt="img">
                                    <div class="card-body">
                                        <label for="image-url">URL:</label>
                                        <input type="text" value="{{ $image->image }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group align-items-center mt-2">
                                                <label class="me-2" for="position">Image postition</label>
                                                <input type="number" class="img-position" class="form-control"
                                                    style="width: 6rem;" id="position" name="postiion"
                                                    value="{{ $image->order_number }}">
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
        const container = document.querySelector('.injection--point');
        const addButton = document.querySelector('.add-gallery-btn');
        let imagesToBeDeleted = document.querySelector('#elementsToBeDeleted');

        let preparationForDelete = [];

        let deleteButtons = document.querySelectorAll('.delete-image');
        let imagesPositions = document.querySelectorAll('.img-position');
        let totalimages = imagesPositions.length;

        const image = `<div class="col">
                    <div class="card shadow-sm">
                        <img src="" alt="img">
                        <div class="card-body">
                            <label for="image-url">URL:</label>
                            <input type="text" value="">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group align-items-center mt-2">
                                    <label class="me-2" for="position">Image postition</label>
                                    <input type="number" class="form-control" style="width: 6rem;"
                                        id="position" class="img-position" name="postiion" value="${totalimages+2}">
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
            container.insertAdjacentHTML('afterbegin', image);
            deleteButtons = document.querySelectorAll('.delete-image');
            reloadButtons();
            updatePositionAndTotal();
        })

        const executeBtn = (element) => {
            const topElement = element.currentTarget.parentElement.parentElement.parentElement.parentElement
                .parentElement;
            try {
                let imageId = topElement.querySelector('.image_id').value;
                preparationForDelete.push(imageId);
                imagesToBeDeleted.value = JSON.stringify(preparationForDelete);
            } catch (e) {
                console.log(e)
            }
            topElement.remove();
            updatePositionAndTotal();
        };

        function reloadButtons() {

            // it clean excess  event listeners when new image is created
            deleteButtons.forEach((button) => {
                button.removeEventListener('click', executeBtn)
            });

            deleteButtons.forEach((button) => {
                button.addEventListener('click', executeBtn);
            });

        }


        reloadButtons();

        function updatePositionAndTotal() {
            imagesPositions = document.querySelectorAll('.img-position');
            totalimages = imagesPositions.length;
            console.log(imagesPositions, totalimages)
        }
    </script>
    {{-- <div class="d-flex justify-content-center">
    {{ $images->links() }}
</div> --}}
@endsection
