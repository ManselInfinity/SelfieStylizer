<?php

session_start();

require_once './../dbConfig.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $email = $_POST['email'];
    $key = $_POST['key'];

    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // shouldnt really happen
    if($key != $_SESSION['key'])
    {
        echo "unauthorised access";
        exit();

    }

    $sql = "update users set password='$hashedPassword' where email='$email'";
    $result = $conn->query($sql);

    ?>

    password reset successfully, redirecting to home page

    <?php

header("refresh:3; Location:./../model6.html");
exit();


}
