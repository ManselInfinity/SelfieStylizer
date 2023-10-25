<?php

require_once './../dbConfig.php';

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
    <link rel="stylesheet" href="./../model6.css">
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
                <li><a href="./../query/test.php">Home</a></li><br><br>
                <li><a href="./stylise.html">Stylise</a></li><br><br>
                <li><a href="./../extraPages/tutorial.html">Tutorial</a></li><br><br>
                <li><a href="./../extraPages/aboutUs.html">About Us</a></li><br><br>
            </ul>
        </div>
    </header>

    <div class="outerDiv">

                <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="Image" style="width:48%; border-radius: 3%;     
                                                                                                border: 2px solid rgba(30, 90, 168, 0.942);">
                
                <br>
                
                <?php
      
                    if(isset($_POST['button1'])) 
                    {
                        $convertedImage = addslashes($imageData);

                        $insert = $conn->query("INSERT into socialGallery (email, image, userName, style) VALUES ('$email', '$convertedImage', '$userName', '$style');");

                        //todo remove before deploy maybe 
                        if ($insert) {
                            $status = 'success';
                            $statusMsg = "parent image uploaded successfully.";
                        } else {
                            $statusMsg = "File upload failed, please try again.";
                        }

                    echo "<script> alert('Image Uploaded Successfully');</script>";
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

