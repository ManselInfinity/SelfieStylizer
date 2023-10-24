<?php
// Include the database configuration file  
require_once './../dbConfig.php';

// Get image data from database ,
$query = "select images.image as parent, tab.image as child from (select * from images where id is null) as tab, images where images.parentId is null and tab.parentId = images.id";
$result = $conn->query($query);

$i = 1;
$nImages = $result->num_rows;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <!-- Slideshow container -->
    <div class="outerDiv">
        <div class="innerDiv"> 
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                    
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="mySlides fade">
                        <div class="numbertext"><?php echo $i ?> / <?php echo $nImages ?></div>
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['parent']); ?>" style="width:48%; border-radius: 3%;     
                                                                                                                          border: 2px solid rgb(96, 111, 160);" alt="img">
                         ⇒ 
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['child']); ?>" style="width:48%; border-radius: 3%;    
                                                                                                                         border: 2px solid rgb(96, 111, 160);" alt="img">
                      
                    </div>
                <?php $i++; } ?>    


                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            
            </div>

            <br>
            <!-- The dots/circles -->
            <div style="text-align:center">
                <?php for($j=1; $j<=$nImages; $j++ )
                    { ?>
                
                    <span class="dot" onclick="currentSlide(<?php echo $j ?>)"></span>
                
                <?php } ?>
            </div>
        </div>
    </div>
    
    <script src="test.js"></script>
</body>
</html>

