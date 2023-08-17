<?php

declare(strict_types=1);

require_once './config.php';

function signupData()
{
    if (isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["errorSignUp"]["emailTaken"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" value="' . $email . '"><br>';
    } elseif (isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["errorSignUp"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" value="' . $email . '"><br>';
    } else {
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email"><br>';
    }

    if (isset($_SESSION["userDetails"]["username"]) && isset($_SESSION["errorSignUp"]["usernameTaken"])){
        $username = $_SESSION["userDetails"]["username"];
        echo '<label>Username:</label><br>';
        echo '<input type="text" name="username" value="' . $username . '"><br>';
    }elseif(isset($_SESSION["userDetails"]["username"]) && isset($_SESSION["errorSignUp"])){
        $username = $_SESSION["userDetails"]["username"];
        echo '<label>Username:</label><br>';
        echo '<input type="text" name="username" value="' . $username . '"><br>';
    }else {
        echo '<label>Username:</label><br>';
        echo '<input type="text" name="username"><br>';
    }

    echo '<label>Password:</label><br>';
    echo '<input type="password" name="password"><br>';
    echo '<label>Confirm Password:</label><br>';
    echo '<input type="password" name="confirm_password"><br>';
}


function CheckSignUpError()
{
    if (isset($_SESSION["errorSignUp"])){
        $errors = $_SESSION["errorSignUp"];
        echo "<br>";
        foreach ($errors as $error){
            echo "<p class='error'>$error</p>";
        }
        unset($_SESSION["errorSignUp"]);
    }elseif (isset($_GET["signup"])){
        if ($_GET["signup"] == "success"){
            header("location: success.php");
        }
    }
}