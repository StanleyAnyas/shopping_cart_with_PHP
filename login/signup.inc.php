<?php
    require_once './config.php';
    include './header.html';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_SPECIAL_CHARS);


        try {
            require_once './database.php';
            require_once './include/signup_model.inc.php';
            require_once './include/signup_contr.inc.php';

            $error = [];

            if (isInputEmpty($username, $password, $confirm_password, $email)) {
                $error["emptyInput"] = "Please fill in all the fields";
            }
            if (isEmailValid($email)) {
                $error["invalidEmail"] = "Invalid email";
            }
            if (isPasswordValid($password, $confirm_password)) {
                $error["passwordsDontMatch"] = "Passwords do not match";
            }
            if (isUsernameTaken($username)) {
                $error["usernameTaken"] = "Username already taken";
            }
            if (isEmailTaken($email)) {
                $error["emailTaken"] = "Email already taken";
            }
            if (count($error) > 0) {
                $_SESSION["errorSignUp"] = $error;

                $userDetails = [
                    "username" => $username,
                    "email" => $email
                ];
                $_SESSION["userDetails"] = $userDetails;
                header("location: index.php");
                die();
            }
            if (insertIntoDatabase($username, $password, $email)) {
                header("location: index.php?signup=success");
                die();
            }
            else{
                checkIfError($conn);
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    include './footer.html';