<?php

require_once './../resources/dbConfig.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    $email = $_SESSION['email'];

    // checking if the user has enough credits
    $query = "select credits from users where email = '$email'";
    $result = $conn->query($query);

    if($result->num_rows != 1) 
    {
        echo "too many users somehow, with the same email";
        die();
    }

    $row = $result->fetch_assoc();
    $credits = $row['credits'];

    if($credits < 10)
    {
        // if credits are not enough, redirect to payment page
        echo "<script>alert('Out of credits, buy more first');
                      window.location.replace('http://localhost/SelfieStylizer/payment/pay.html');</script>";
        die();
    }

    
    $style = $_POST['style'];
    $_SESSION['style'] = $style;

    // Directory to save images
    $uploadDirectory = 'temp/';

    // Get the image data
    $imageData = file_get_contents($_FILES['image']['tmp_name']);

    // save the image as temp
    $uniqueFilename = ''. $_FILES['image']['name'];

    // Save the image to the directory
    if (file_put_contents($uploadDirectory . $uniqueFilename, $imageData)) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }
    

    // determine which os php is running on, and run the appropriate command
    if (strtoupper(substr(PHP_OS_FAMILY, 0, 3)) === 'WIN') {
        // It refused to work with a venv in windows, run it directly
        $command = "python evaluate.py --model_name $style --input $uniqueFilename";
    
    } else {
        $command = "source env/bin/activate; python evaluate.py --model_name $style --input $uniqueFilename; exit";
    }

    //$command = 'source env/bin/activate; python evaluate.py';

    $output = null;
    $retval = null;

    // spawn a shell and run the command
    exec($command, $output, $retval);

    // echo "Returned with status $retval and output:\n";
    // print_r($output);
 

    //-------------------------------- image saving and stuff-----------------------------------------------------

    // getting the parent and converted images 
    $parentImage = addslashes($imageData);

    $imageFilePath = './results/temp.png';

    if ( !file_exists($imageFilePath) ) {
        //! do something more here
        //? redirect maybe? 
        echo "<script> alert('face not found, upload another image'); </script>";
        die();
    }

    // Read the image data
    $cnvImage = file_get_contents($imageFilePath);
    $convertedImage = addslashes($cnvImage);

    // generate a unique id for the image 
    $parentId = uniqid();



  
    // $email = 'manselismyname@gmail.com';

    // Insert parent image into database 
    $insert = $conn->query("INSERT into images (id, email, image, parentId) VALUES ('$parentId', '$email', '$parentImage', NULL)");

    //todo remove before deploy maybe 
    if ($insert) {
        $status = 'success';
        $statusMsg = "parent image uploaded successfully.";
    } else {
        $statusMsg = "File upload failed, please try again.";
    }

    // Insert converted image into database 
    $insert = $conn->query("INSERT into images (email, image, parentId) VALUES ('$email', '$convertedImage', '$parentId')");

    //todo remove before deploy maybe 
    if ($insert) {
        $status = 'success';
        $statusMsg = "converted image uploaded successfully.";
    } else {
        $statusMsg = "File upload failed, please try again.";
    }
    
    // deducting the credits appropriately 
    // deduct 10 credits per image converted
    $credits -= 10;

    $query = "update users set credits = $credits where email = '$email'";
    $result = $conn->query($query);

    

    //-------------------------------- clearing the temp folders ------------------------------------- 

    $files = glob('./temp/*'); // get all file names
    foreach($files as $file){ // iterate files
      if(is_file($file)) {
        unlink($file); // delete file
      }
    }
    
    file_put_contents('./temp/DontDeleteThis.txt', "");
    unlink('./results/temp.png');

    //--------------------------------- do whatever now ---------------------------------------

    $_SESSION['image'] = $cnvImage;
    
    header("Location:./display.php");

}

?> 

