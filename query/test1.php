<?php

// Include the database configuration file  
require_once './../dbConfig.php';

// Get image data from database ,
// selecting any 3 images at random 

$query = "select images.image as parent, tab.image as child from (select * from images where id is null) as tab, images where images.parentId is null and tab.parentId = images.id";
$result = $conn->query($query);
?>

<!-- Display images with BLOB data from database -->
<?php if ($result->num_rows > 0) { ?>
    <div class="gallery">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['parent']); ?>" />
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['child']); ?>" />
        <?php } ?>
    </div>
<?php } else { ?>
    <p class="status error">Image(s) not found...</p>
<?php } 

// array to store the images
$images = [];