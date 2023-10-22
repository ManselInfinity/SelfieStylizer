
<?php
// Include the database configuration file  
require_once './../dbConfig.php';

// Get image data from database 
$result = $conn->query("SELECT image FROM images");
?>

<html>
    <head>
        <link rel="stylesheet" href="query.css">
    </head>

    <body>

    <div class="outerDiv">
        <div class="innerDiv">
        
    
        <!-- Display images with BLOB data from database -->
        <?php if ($result->num_rows > 0) { ?>
            <div class="gallery">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <br>
                    <img style="max-width: 350px; max-height: 250px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
                    <br>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="status error">Image(s) not found...</p>
        <?php } ?>

        </div>
    </div>

    </body>


</html>

