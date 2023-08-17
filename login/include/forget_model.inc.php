<?php
declare(strict_types=1);

require_once './database.php';

function checkIfEmailExistInDatabase($email): bool {
    global $conn;
    if($conn){
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
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

function changePasswordInDatabase($email, $newPassword): bool 
{
    global $conn;
    if($conn){
        $stmt = $conn->prepare("UPDATE users SET pwd = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}