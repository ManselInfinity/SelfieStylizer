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
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
 integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="home.css">
</head>
<body>
    
    
    <div class="header">
    <i class="fas fa-bars" id="show-menu"></i>
        <div class="l">
        </div>
        
        <div class="mid">
            <ul class="navbar" id="nav-menu">
                <li><a class="te" href=""><i class=" fa-sharp fa-solid fa-house"></i>HOME</a></li><br><br>
                <li><a class="te"  href="./../stylise/stylise.html"><i class=" fa-solid fa-plus"></i>STYLISE</a></li><br><br>
                <li><a class="te" href="./../socialGallery/social.php"><i class="fas fa-image"></i>S-GALLERY</a></li><br><br>
                <li><a class="te" href="./../extraPages/tutorial.html"><i class=" fa-solid fa-school"></i>TUTORIAL</a></li><br><br>
                <li><a class="te" href="./../payment/pay.html"><div class="oo" > <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" ><path fill="currentColor" d="m22.436 0l-11.91 7.773l-1.174 4.276l6.625-4.297L11.65 24h4.391l6.395-24zM14.26 10.098L3.389 17.166L1.564 24h9.008l3.688-13.902Z" /></svg></div><div class="pay" > PAY</div></a></li><br><br>
                <li><a class="te" href="./../extraPages/aboutUs.html"><i class=" fa-solid fa-address-card"></i> ABOUT US</a></li><br><br>
            </ul>
        </div>
    </div>

    <!-- <header>
        <i class="fas fa-bars" id="show-menu"></i>
  
        <div class="l">
        </div>
        <div class="col">
        </div>

        <div class="mid">
            <ul class="navbar" id="nav-menu">
              
                <li><a class="text" href="#">  <i class="fa-sharp fa-solid fa-house"></i> HOME</a></li><br><br>
                <li><a class="text" href="#"> <i class="fa-solid fa-plus"></i> STYLISE </a></li><br><br>
                <li><a class="text" href="#">  <i class="fa-solid fa-rectangle-history-circle-user"></i> S-GALLERY</a></li><br><br>
                <li><a class="text" href="#">  <i class="fa-solid fa-school"></i> TUTORIAL</a></li><br><br>
                <li><a class="text" href="#">  <i class="fa-brands fa-amazon-pay"></i>  PAY</a></li><br><br>
                <li><a class="text" href="#"> <i class="fa-solid fa-address-card"></i> ABOUT US</a></li><br><br>
                <li><a>""</a></li>
                <li><a>""</a></li>
           
                <li><button class="btnlogin-popup">  <i class="fa-solid fa-right-to-bracket"></i> LOGIN</button></li>
            </ul>
        </div>
    </header> -->

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
    <!-- <script src="e.js"></script> -->
</body>
</html>

