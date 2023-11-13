<?php
// Include the database configuration file  
require_once './../resources/dbConfig.php';

session_start();

// Get image data from database ,
// select the parent and converted image, 
// at random, and limited to 3 at most


$email = $_SESSION['email'];

// $email='manselismyname@gmail.com';

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
    <link rel="stylesheet" href="s.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
 integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    
    <div class="header">
    <i class="fas fa-bars" id="show-menu"></i>
        <div class="l">
        </div>
        
        <div class="mid">
            <ul class="navbar" id="nav-menu">
                <li><a class="te" href="./../home/home.php"> <i class="fa-sharp fa-solid fa-house"></i>HOME</a></li><br><br>
                <li><a class="te"  href="./../stylise/stylise.html"><i class=" fa-solid fa-plus"></i>STYLISE</a></li><br><br>
                <li><a class="te" href=""> <i class="fas fa-image"></i>S-Gallery</a></li><br><br>
                <li><a class="te" href="./../extraPages/tutorial.html"><i class=" fa-solid fa-school"></i>TUTORIAL</a></li><br><br>
                <li><a class="te" href="./../payment/pay.html"> <svg style="      margin-right: 100%;
      margin-left: -444%;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" ><path fill="currentColor" d="m22.436 0l-11.91 7.773l-1.174 4.276l6.625-4.297L11.65 24h4.391l6.395-24zM14.26 10.098L3.389 17.166L1.564 24h9.008l3.688-13.902Z" /></svg>PAY</a></li><br><br>
            
                <li><a class="te" href="./../extraPages/aboutUs.html"><i class=" fa-solid fa-address-card"></i> ABOUT US</a></li><br><br>
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
                                <figcaption> <b style="color:antiquewhite"; style="font-size: 800px";  style="font-weight:bold;"><a class="tt" >User:</b> <b style="color:rgb(160, 200, 235);"; ><?php echo $row['userName'];?> </b>     <b style="color:antiquewhite" >Style:</b> <b style="color:rgb(160, 200, 235);"><?php echo $row['style'];?> </b></a></figcaption>                            
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

    
    <script src="s.js"></script>
</body>
</html>

