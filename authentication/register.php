<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "hello";

    // connecting to database 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SelfieStylizer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * from users where users.email = '$email'";
    $result = $conn->query($sql);

    // !
    //  ! IF USER already REGISTERED  
    // !

    if ($result->num_rows != 0)
        echo "email already registered, choose another email ";
    // do something 


    // hashing entered password 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users VALUES('$email', '$hashedPassword', 100)";
    $conn->query($sql);



    //! redirect to signin page now

    header("Location:.\..\model6.html");


}

?>