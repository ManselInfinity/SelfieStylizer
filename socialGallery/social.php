<?php
// Include the database configuration file  
require_once './../resources/dbConfig.php';

session_start();

// Get image data from database ,
// select the parent and converted image, 
// at random, and limited to 3 at most
$email = $_SESSION['email'];
$query = "select image, userName, style from socialGallery order by rand() limit 6";
$result = $conn->query($query);

$i = 1;
$nImages = $result->num_rows;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S-Gallery</title>
    <link rel="stylesheet" href="./social.css">
</head>
<body>
    
    
    <div class="header">
        <div class="l">
        </div>
        
        <div class="mid">
            <ul class="navbar">
                <li><a href="./../home/home.php">Home</a></li><br><br>
                <li><a href="./../stylise/stylise.html">Stylise</a></li><br><br>
                <li><a href="">S-Gallery</a></li><br><br>
                <li><a href="./../extraPages/tutorial.html">Tutorial</a></li><br><br>
                <li><a href="./../payment/pay.html">Pay</a></li><br><br>
                <li><a href="./../extraPages/aboutUs.html">About Us</a></li><br><br>
            </ul>
        </div>
    </div>

    <br>
    
    <div class="outerDiv" style="height: 100%; width: 100%;
                                 margin-left: 8.3%;
                                 margin-top: -4%;">
        <!-- User Info container -->
        <div class="outerDiv" style="width: 110%;">
            <div class="innerDiv" style="border-radius: 0px;">
                <h1 style="color: white;
                           line-height: 10%;
                           font-size: 3em;">S-Gallery</h1>  

        </div>

        <!-- Slideshow container -->
        <div class="outerDiv" style="height: 70%; width: 70%;
                                     position: relative;
                                     left: 7%;
                                     margin-top: 1%;">
            <div class="innerDiv"> 
                <div class="slideshow-container">

                    <!-- Full-width images with number and caption text -->
                        
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="mySlides fade">
                            <div class="numbertext"><?php echo $i ?> / <?php echo $nImages ?></div>
                            <figure>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:48%; border-radius: 3%;     
                                                                                                                                border: 2px solid rgba(30, 90, 168, 0.942);
                                                                                                                                position:relative;
                                                                                                                                left: 27%;" alt="img">
                                <figcaption> <b style="font-weight:bold;">User:</b> <b style="color:rgb(160, 200, 235);"><?php echo $row['userName'];?> </b>     <b>Style:</b> <b style="color:rgb(160, 200, 235);"><?php echo $row['style'];?> </b></figcaption>                            
                            </figure>
                        
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

    </div>

    
    <script src="social.js"></script>
</body>
</html>

