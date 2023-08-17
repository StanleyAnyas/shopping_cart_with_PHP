<?php

declare(strict_types=1);

require_once "database.php";

function createTableIfNotExists (): bool
{
    global $conn;
    if ($conn){
        $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS users (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            pwd VARCHAR(255) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )");

        if($stmt->execute()){
            return true;
        }
        $stmt->close();
        return false;
    }
    return false;
}

function checkUsernameIfTaken (string $username): bool
{
    global $conn;
    if ($conn){
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?;");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }
        $stmt->close();
        return false;
    }
}

function checkEmailIfTaken (string $email): bool
{
    global $conn;
    if ($conn){
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }
        $stmt->close();
        return false;
    }
    
}


function insertIntoDatabase (string $username, string $hashed_password, string $email): bool
{
    global $conn;
    if ($conn){
        $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS users (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            pwd VARCHAR(255) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )");

        $stmt->execute();
        $stmt = $conn->prepare("INSERT INTO users (username, pwd, email) VALUES (?, ?, ?)");
        $hashed_password = password_hash($hashed_password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt->bind_param("sss", $username, $hashed_password, $email);
        if($stmt->execute()){
            return true;
        }
        $stmt->close();
        return false;
    }
    return false;
    
}

function checkIfError ($conn){
    global $conn;
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
}