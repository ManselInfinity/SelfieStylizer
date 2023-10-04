<?php

session_start();

require_once './../dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_COOKIE['key']))
{
    
    $cookieKey = $_COOKIE["key"];
    $key = $_GET['key'];
    $email = $_GET['email'];

    // if the user cookie key matches the redirect link key
    // to prevent access from locations other than the redirect link
    if($key === $cookieKey)
    {
        $sql = "SELECT * from users where users.email = '$email'";
        $result = $conn->query($sql);
    
        $row = $result->fetch_assoc();
        
        //if the user comes here somwhow, should almost never occur
        if ($result->num_rows == 0)
            echo "Where on earth did you come from ";

        $_SESSION['email'] = $email;
        $_SESSION['key'] = $key;

        // delete the cookie
        // (eat it)
        setcookie("key", "", time() - 3600);
        
        ?>
            
            <form method="post" action="submitNew.php">
            <input type="hidden" name="email" value="<?php echo $email;?>">
            <input type="hidden" name="key" value="<?php echo $key;?>">
            <p>Enter New password</p>
            <input type="password" name='password'>
            <input type="submit" name="submit">
            </form>

        <?php
        
    }
}