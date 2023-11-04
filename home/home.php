<?php
// Include the database configuration file  
require_once './../resources/dbConfig.php';

session_start();

// Get image data from database ,
// select the parent and converted image, 
// at random, and limited to 3 at most
$email = $_SESSION['email'];
$query = "select images.image as parent, tab.image as child from (select * from images where id is null and email = '$email') as tab, images where images.parentId is null and tab.parentId = images.id and images.email = '$email' order by rand() limit 3";
$result = $conn->query($query);

// retrieving credits from database, and user name
$query = "select credits, userName from users where email = '$email'";
$result1 = $conn->query($query);
$row = $result1->fetch_assoc();
$credits = $row['credits'];
$userName = $row['userName'];

$i = 1;
$nImages = $result->num_rows;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    
    
    <div class="header">
        <div class="l">
        </div>
        
        <div class="mid">
            <ul class="navbar">
                <li><a href="">HOME</a></li><br><br>
                <li><a href="./../stylise/stylise.html">STYLISE</a></li><br><br>
                <li><a href="./../socialGallery/social.php">S-GALLERY</a></li><br><br>
                <li><a href="./../extraPages/tutorial.html">TUTORIAL</a></li><br><br>
                <li><a href="./../payment/pay.html">PAY</a></li><br><br>
                <li><a href="./../extraPages/aboutUs.html">ABOUT US</a></li><br><br>
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
                           font-size: 3em;"><?php echo $userName; ?></h1>  
                <br>
                <div style="color: white;
                           line-height: 1%;
                           position: relative;
                           top: -15px;">Credits: <?php echo $credits;?> </div>
            </div>
        </div>

        <!-- Slideshow container -->
        <div class="outerDiv" style="height: 85%; width: 85%;
                                     position: relative;
                                     left: 8%;">
            <div class="innerDiv"> 
                <div class="slideshow-container">

                    <!-- Full-width images with number and caption text -->
                        
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="mySlides fade">
                            <div class="numbertext"><?php echo $i ?> / <?php echo $nImages ?></div>
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['parent']); ?>" style="width:48%; border-radius: 3%;     
                                                                                                                            border: 2px solid rgba(30, 90, 168, 0.942);" alt="img">
                            <!-- <h1 style="color: white; font-size: 1em;"> ⇒ </h1>  -->
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['child']); ?>" style="width:48%; border-radius: 3%;    
                                                                                                                            border: 2px solid rgba(29, 109, 143, 0.942);" alt="img">
                        
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

    
    <script src="home.js"></script>
</body>
</html>

