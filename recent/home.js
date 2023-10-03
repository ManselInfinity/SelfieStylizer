function showImage(imageSrc) {
    var modal = document.getElementById("image-modal");
    var modalImage = document.getElementById("enlarged-image");

    modal.style.display = "block";
    modalImage.src = imageSrc;
}

function closeImageModal() {
    var modal = document.getElementById("image-modal");
    modal.style.display = "none";
}
