<?php
      require_once './config.php';
      include 'database.php';
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST["email"];
            $newPassword = $_POST['newPassword'];
            $confirmNewPassword = $_POST['confirmNewPassword'];

            try {
                require_once './database.php';
                require_once './include/forget_model.inc.php';
                require_once './include/forget_contr.inc.php';
                require_once './include/forget_view.inc.php';

                $error = [];

                if (isInputEmpty($email, $newPassword, $confirmNewPassword)){
                    $error["emptyInput"] = "Please fill in all the fields";
                    checkErrors();
                }
                if (isEmailValid($email)){
                    $error["invalidEmail"] = "Invalid email";
                }
                if (isPasswordValid($newPassword)){
                    $error["invalidPassword"] = "Password must be at least 8 characters long";
                }
                if (isPasswordSame($newPassword, $confirmNewPassword)){
                    $error["passwordNotSame"] = "Password does not match";
                }
                hashPassword($newPassword);
                if (!CheckIfEmailExist($email)){
                    $error["emailNotExists"] = "Email does not exist";
                }

                if (count($error) > 0){
                    $_SESSION["forgetError"] = $error;

                    $userDetails = [
                        "email" => $email,
                    ];
                    $_SESSION["userDetails"] = $userDetails;
                    header("Location: forgot.php");
                    die();
                }
                if(changePasswordInDatabase($email, $newPassword)){
                    header("Location: login.php?passwordChange=success");
                }

            } catch (mysqli_sql_exception $e) {
                echo "Error: " . $e->getMessage();  
            }
                
        }