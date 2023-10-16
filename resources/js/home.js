window.addEventListener("load", function () {
    const galleryIdCopy = document.querySelectorAll(".gallery-id-copy");
    let galleryIdPaste = document.querySelector(".gallery-id-paste");

    galleryIdCopy.forEach((element) => {
        element.addEventListener("click", (e) => {
            galleryIdPaste.value = e.target.getAttribute("gallery_id");
        });
    });
});
