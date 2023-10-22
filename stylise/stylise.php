<?php

require_once './../dbConfig.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    $style = $_POST['style'];

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
    $convertedImage = addslashes(file_get_contents($imageFilePath));

    // generate a unique id for the image 
    $parentId = uniqid();

    $email = $_SESSION['email'];

    //! remove before deploy
    $email = 'manselismyname@gmail.com';

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

    // clearing the temp folders 

    $files = glob('./temp/*'); // get all file names
    foreach($files as $file){ // iterate files
      if(is_file($file)) {
        unlink($file); // delete file
      }
    }
    
    file_put_contents('./temp/DontDeleteThis.txt', "");
    unlink('./results/temp.png');


    header("Location:./display.php");

}

?> 

