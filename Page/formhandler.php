<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // check if there are empty fields
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        die("Please fill in all fields");
        header("location: index2.php");
    }elseif(!preg_match("/^(?=.*\d)+(?=.*\p{Ll})+(?=.*\p{Lu})+(?=.*[!#$£€@%&¨'*+=^_``|~()\-\s.]).{8,}$/uim", $_POST["password"])){ // here i check if the password satisfies the requirements
        die("Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit");
        header("location: index2.php");
    }else{
        $username = $_POST["name"];
        $email = $_POST["email"];
        $pwd = $_POST["password"];
    }
    // hash password
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);

    try {
        require_once "database2.php";

        $query = "CREATE TABLE IF NOT EXISTS users(
                    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                   username VARCHAR(255) NOT NULL,
                   email VARCHAR(255) NOT NULL,
                    pwd VARCHAR(255) NOT NULL,
                   created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        
        // check if user already exists
        $query = "SELECT * FROM users WHERE email = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        if($result){
            die("User already exists");
            header("location: index2.php");
        }else{
        $query2 = "INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd);";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(":username", $username);
        $stmt2->bindParam(":email", $email);
        $stmt2->bindParam(":pwd", $pwd);
   

        if($stmt2->execute()){
            $user_id = $pdo->lastInsertId();
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["pwd"] = $pwd;
            $_SESSION["id"] = $user_id;
        }
        $pdo = null;
        $stmt = null;
        $stmt2 = null;

        header("location: welcome.php");
        die();
    }
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    }

}else{
    header("location: index2.php");
    die("Query failed" . $e->getMessage());
}