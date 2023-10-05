<?php
// Path to the image file
$imageFilePath = './results/temp.png';

// Read the image data
$imageData = file_get_contents($imageFilePath);

// Convert the image data to base64
$base64Image = base64_encode($imageData);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Image Display</title>
</head>

<body>
    <!-- Display the image using a data URL -->
    <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="Image">
</body>

</html>