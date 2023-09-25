<?php

session_start();

require_once './../dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    // retrieving old and new password
    $oldPassword = $_POST['OldPassword'];
    $newPassword = $_POST['newPassword'];

    $email = $_SESSION['email'];

    $sql = "SELECT * from users where users.email = '$email'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    //verifying entered password with whats in the database 
    if (password_verify($oldpassword, $row['password'])) 
    {
        
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // password matches, change it now
        $sql = "update users set password = '$newPassword' where users.email = '$email'";
        $result = $conn->query($sql);

    }
    else
    {
        //! not correct, enter password again
        //! OR.... you're an IMPOSTER !!
    }    

}