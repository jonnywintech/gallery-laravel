window.addEventListener("load", function () {
    let container = document.querySelector(".injection--point");
    let addButton = document.querySelector(".add-gallery-btn");
    let imagesToBeDeleted = document.querySelector("#elementsToBeDeleted");

    let galleryNameCopy = document.querySelector(".gallery-name-copy");
    let galleryNamePaste = document.querySelector(".gallery-name-paste");

    let galleryUrlCopy = document.querySelector(".gallery-url-copy");
    let galleryUrlPaste = document.querySelector(".gallery-url-paste");

    let preparationForDelete = [];

    let deleteButtons = document.querySelectorAll(".delete-image");

    let totalImages =
        document.querySelectorAll(".img-position").length + 2 ?? 0;

    addButton.addEventListener("click", () => {
        container.insertAdjacentHTML("afterbegin", image);
        // update delete buttons
        reloadButtons();
    });

    const executeBtn = (element) => {
        const topElement =
            element.currentTarget.parentElement.parentElement.parentElement
                .parentElement.parentElement;
        if (topElement.querySelector(".image_id")) {
            let imageId = topElement.querySelector(".image_id").value;
            preparationForDelete.push(imageId);
            imagesToBeDeleted.value = JSON.stringify(preparationForDelete);
        }
        topElement.remove();
    };

    function reloadButtons() {
        // it clean excess  event listeners when new image is created
        deleteButtons = document.querySelectorAll(".delete-image");

        deleteButtons.forEach((button) => {
            button.removeEventListener("click", executeBtn);
        });

        deleteButtons.forEach((button, index) => {
            button.addEventListener("click", executeBtn);
        });
    }

    reloadButtons();

    galleryNameCopy.addEventListener("change", () => {
        galleryNamePaste.value = galleryNameCopy.value;
    });

    galleryUrlCopy.addEventListener("change", () => {
        galleryUrlPaste.value = galleryUrlCopy.value;
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
                                            value="${totalImages}" />
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
});
