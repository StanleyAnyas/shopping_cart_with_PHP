<?php
declare(strict_types=1);

require_once './database.php';

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

function checkIfPasswordIsCorrect(string $username, string $email, string $password): bool {
    global $conn;
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND pwd IS NOT NULL");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['pwd'];
            if (password_verify($password, $hashedPassword)) {
                return true;
            }
        }

        $stmt->close();
    }
    return false;
}
