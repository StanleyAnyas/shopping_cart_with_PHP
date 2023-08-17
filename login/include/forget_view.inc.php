<?php
declare(strict_types=1);

require_once './config.php';

function forgotPasswordData()
{
    if(isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["forgetError"]["emptyInput"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email" value="'. $email . '"> <br>';
    }elseif(isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["forgetError"]["invalidEmail"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email" value="'. $email .'"> <br>';
    }elseif(isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["forgetError"]["invalidPassword"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email" value="'. $email .'"> <br>';
    }elseif(isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["forgetError"]["passwordNotSame"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email" value="'. $email .'"> <br>';
    }elseif(isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["forgetError"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email" value="'. $email .'"> <br>';
    }else{
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email"> <br>';
    }

    echo '<label for="newPassword">New Password</label>';
    echo '<input type="password" name="newPassword" id="newPassword"> <br>';
    echo '<label for="confirmNewPassword">Confirm New Password</label>';
    echo '<input type="password" name="confirmNewPassword" id="confirmNewPassword"> <br>';

}

function checkErrors()
{
    if(isset($_SESSION["forgetError"])){
        $errors = $_SESSION["forgetError"];
        echo "<br>";
        foreach($errors as $error){
            echo "<p class='error'>$error</p>";
        }
        unset($_SESSION["forgetError"]);
        die();
    }elseif(isset($_GET["passwordChange"])){
        if($_GET["passwordChange"] == "success"){
            header("location: login.php");
        }
    }
}

