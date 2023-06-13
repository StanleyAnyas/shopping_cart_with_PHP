<?php

    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $favourite_food = $_POST["favourite_food"];

    try {
        require_once "database2.php";
        // create table if it doesn't exist and name a column user_id and it will be a foreign key referencing the id column in the users table
        $query = "CREATE TABLE IF NOT EXISTS favourite_foods(
                    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    favourite_food VARCHAR(255) NOT NULL,
                    user_id INT(11) NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(id)
                );";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $query2 = "INSERT INTO favourite_foods (favourite_food, user_id) VALUES (:favourite_food, :user_id);";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(":favourite_food", $favourite_food);
        $stmt2->bindParam(":user_id", $_SESSION["id"]);
        if($stmt2->execute()){
            $_SESSION["favourite_food"] = $favourite_food;
        }

        $pdo = null;
        $stmt = null;
        $stmt2 = null;

        header("location: page.php");
        die();
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    }

}else{
    header("location: welcome.php");
    die();
}