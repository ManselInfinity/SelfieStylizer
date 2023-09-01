<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directory to save images
    $uploadDirectory = '';

    // Get the image data
    $imageData = file_get_contents($_FILES['image']['tmp_name']);

    // Generate a unique filename
    $uniqueFilename = uniqid() . '_' . $_FILES['image']['name'];

    // Save the image to the directory
    if (file_put_contents($uploadDirectory . $uniqueFilename, $imageData)) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
</body>

</html>