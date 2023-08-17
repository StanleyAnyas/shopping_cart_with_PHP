<?php 
declare(strict_types=1);

require_once './config.php';

function loginData(){
    if(isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["loginError"]["incorrectInput"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email" value="'. $email . '"> <br>';
    }elseif(isset($_SESSION["userDetails"]["email"]) && isset($_SESSION["loginError"])){
        $email = $_SESSION["userDetails"]["email"];
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email" value="'. $email .'"> <br>';
    }
    else{
        echo '<label for="email">Email</label>';
        echo '<input type="text" name="email" id="email"> <br>';
    }
    if(isset($_SESSION["userDetails"]["username"]) && isset($_SESSION["loginError"]["incorrectInput"])){
        $username = $_SESSION["userDetails"]["username"];
        echo '<label for="username">Username</label>';
        echo '<input type="text" name="username" id="username" value="'. $username .'"> <br>';
    }elseif(isset($_SESSION["userDetails"]["username"]) && isset($_SESSION["loginError"])){
        $username = $_SESSION["userDetails"]["username"];
        echo '<label for="username">Username</label>';
        echo '<input type="text" name="username" id="username" value="'. $username .'"> <br>';
    }else{
        echo '<label for="username">Username</label>';
        echo '<input type="text" name="username" id="username"> <br>';
    }
    echo '<label for="password">Password</label>';
    echo '<input type="password" name="password" id="password"> <br>';
}

function checkIfLoginError(){
    if(isset($_SESSION["loginError"])){
        $errors = $_SESSION["loginError"];
        echo "<br>";
        foreach($errors as $error){
            echo "<p class='error'>$error</p>";
        }
        unset($_SESSION["loginError"]);
    }elseif(isset($_GET["login"])){
        if($_GET["login"] == "success"){
            header("location: profile.php");
        }
    }
}