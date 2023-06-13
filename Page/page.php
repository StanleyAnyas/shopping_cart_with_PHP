<?php
// start session
session_start();
$name = $_SESSION["username"];
$email = $_SESSION["email"];
$pwd = $_SESSION["pwd"];
$favourite_food = $_SESSION["favourite_food"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h2>Profile</h2>
    <p>Name: <?php echo $name; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Favourite food: <?php echo $favourite_food; ?></p>
</body>
</html>
