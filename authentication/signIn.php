<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // $enteredPassword = password_hash($password, PASSWORD_DEFAULT);
    // echo $enteredPassword;

    //echo "email = $email, password = $password";

    // connecting to database 

    // hello

    $dummy = 'hello';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SelfieStylizer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * from users where users.email = '$email'";
    $result = $conn->query($sql);

    // !
    //  ! IF USER NOT REGISTERED  
    // !

    if ($result->num_rows == 0)
        echo "email not registered, register ";

    $row = $result->fetch_assoc();

    // hashing entered password to compare with whats in the database 

    // $enteredPassword = password_hash($password, PASSWORD_DEFAULT);

    // echo "entered password hash = $enteredPassword";
    // $pass = $row['password'];
    // echo "stored password hash = $pass ";

    if (password_verify($password, $row['password'])) {
        // User authentication valid, let user through, 
        //? give user some token maybe 

        echo "password entered is correct";

    } else {
        // password not valid, enter again
        echo "incorrect password";

    }


}

?>