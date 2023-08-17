<?php
    require_once './config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        try{
            require_once './database.php';
            require_once './include/login_model.inc.php';
            require_once './include/login_contr.inc.php';

            $error = [];

            if (isInputEmpty($username, $password, $email)){
                $error["emptyInput"] = "Please fill in all the fields";
            }
            if (isEmailValid($email)){
                $error["invalidEmail"] = "Invalid email";
            }
            sanitizeInput($username, $password, $email);
            createTableIfNotExists();
            if(!checkIfPasswordIsCorrect($username, $email, $password)){
                $error["incorrectInput"] = "Incorrect input";
            }

            if (count($error) > 0){
                $_SESSION["loginError"] = $error;

                $userDetails = [
                    "username" => $username,
                    "email" => $email,
                ];
                $_SESSION["userDetails"] = $userDetails;
                header("Location: login.php");
                die();
            }
            // $newSessionId = session_create_id();
            // $sessionId = $newSessionId . "_" . $id;
            // session_id($sessionId);
            $username = htmlspecialchars($username);
            setcookie("username", $username, time() + 3600, "/");
            header("Location: login.php?login=success");
            $conn = null;
            die();
        }
        catch(mysqli_sql_exception $e){
            echo "Error: " . $e->getMessage();
        }
       
    }