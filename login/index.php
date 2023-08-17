<?php
    require_once './config.php';
    require_once './include/signup_view.inc.php';

    error_reporting(E_ALL); // this is for error reporting
    ini_set('display_errors', '0'); // this hides all errors

    function customErrorHandler($errno, $errstr, $errfile, $errline)
    {
        $errorMessage = "<b>Error:</b> [$errno] $errstr - $errfile:$errline";
        error_log($errorMessage . PHP_EOL, 3, "error_log.txt");
    }

    set_error_handler("customErrorHandler");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <p>
            Signup to our website
        </p>
    </div>
    <form action = "signup.inc.php" method = "post">
        <div class="header">
            <h1>SIGNUP</h1>
        </div><br>
        <?php
            signupData();
        ?>
        <input type="submit" name="signup" value="siginup">
        <p>Already a user? <a name="login" href="login.php">Login</a></p>
        <?php
            CheckSignUpError();
        ?>
    </form>
</body>
</html>