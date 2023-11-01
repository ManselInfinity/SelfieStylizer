<?php

session_start();

require_once './../resources/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_COOKIE['key']))
{
    

    // http://localhost/SelfieStylizer/authentication/resetPassword.php?email=manselismyname@gmail.com&?key=5b7b6a6
    $cookieKey = $_COOKIE["key"];
    $key = $_GET['key'];
    $email = $_COOKIE['email'];

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
            
            <body style="background: url('./../img21.webp');
                        background-color: rgba(128, 128, 128, 0.589);
                        background-blend-mode: multiply;
                        background-size: cover;
                        background-repeat: no-repeat;">

                <div style="  display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                margin: 0;">
                    <div style="        
                            
                                background: rgba(1, 16, 29, 0.699);
                                
                                padding: 30px;
                                
                                border: 2px solid rgb(214, 232, 233);
                                border-radius: 20px;
                                backdrop-filter: blur(10px);
                                box-shadow: 0 0 30px rgba(0, 0, 0, .5);
                                                ">

                                <form method="post" action="submitNew.php">
                                <input type="hidden" name="email" value="<?php echo $email;?>">
                                <input type="hidden" name="key" value="<?php echo $key;?>">
                                <p>Enter New password</p>
                                <input type="password" name='password'>
                                <input type="submit" name="submit">
                                </form>
                    </div>
                </div>
            </body>

        <?php
        
    }
}