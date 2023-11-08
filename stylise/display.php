<?php

require_once './../resources/dbConfig.php';

$flag=true;

session_start();

$imageData = $_SESSION['image'];
$email = $_SESSION['email'];
$style = $_SESSION['style'];

$result = $conn->query("select userName from users where email = '$email';");
$row = $result->fetch_assoc();

$userName = $row['userName'];

// unset($_SESSION['image']);

// Convert the image data to base64
$base64Image = base64_encode($imageData);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Converted Image</title>
    <link rel="stylesheet" href="./../resources/model6.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
 integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    
<header>
        <!-- <h2 class="logo">logo</h2>
        <nav class="navigation">
            <a href="#">home</a>
            <a href="#">about</a>
            <a href="#">contact us</a>
            <a href="#">tutorial</a>
            <button class="btnlogin-popup">login</button>
        </nav> -->
        <div class="l">
        </div>
        <div class="mid">
            <ul class="navbar">
                
            <li><a class="te" href="./../home/home.php"> <i class="fa-sharp fa-solid fa-house"></i>HOME</a></li><br><br>
                <li><a class="te"  href="./../stylise/stylise.html"><i class=" fa-solid fa-plus"></i>STYLISE</a></li><br><br>
                <li><a class="te" href="./../socialGallery/social.php"><i class="fas fa-image"></i>S-GALLERY</a></li><br><br>
                <li><a class="te" href="./../extraPages/aboutUs.html"><i class=" fa-solid fa-address-card"></i> ABOUT US</a></li><br><br>
                <li><a  href="./../model6.html"> <button class="logout">  <i class="fa-solid fa-right-to-bracket"></i> LOGOUT</button></li> </a>
            </ul>
        </div>
    </header>

    <div class="outerDiv">

                <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="Image" style="width:48%; border-radius: 3%;     
                                                                                                border: 2px solid rgba(30, 90, 168, 0.942);">
                
                <br>
                
                <?php

                if (isset($_POST['button1'])) {
                    $convertedImage = addslashes($imageData);
                    if ($flag) {
                        $insert = $conn->query("INSERT into socialGallery (email, image, userName, style) VALUES ('$email', '$convertedImage', '$userName', '$style');");
                        $flag = false;
                        echo "<script> alert('Image Uploaded Successfully');</script>";
                    } else {
                        echo "<script> alert('Image Already Uploaded');</script>";

                    }
                }
                ?> 
    
                <form method="post"> 
                    <input type="submit" value="Upload To S-Gallery"
                            name="button1" class="innerDivHover" style="color:aliceblue;"> 
                </form> 
                
                
                <a href="data:image/jpeg;base64,<?php echo $base64Image; ?>" download="ConvertedImage" style="text-decoration: none;">
                    <div class="innerDivHover">
                        <div style="color:aliceblue"> Download Image ↓</div>
                    </div>
                </a>
    </div>
    
    <script src="model6.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>

