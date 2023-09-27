
// JavaScript to display the selected image
const fileInput = document.getElementById("fileInput");
const imagePreview = document.getElementById("imagePreview");

fileInput.addEventListener("change", function () {
    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            img.style.maxWidth = "100%";
            img.style.maxHeight = "300px"; // Limit the image size for display

            // Clear any previous image previews
            while (imagePreview.firstChild) {
                imagePreview.removeChild(imagePreview.firstChild);
            }

            imagePreview.appendChild(img);
        };

        reader.readAsDataURL(file);
    }
});
